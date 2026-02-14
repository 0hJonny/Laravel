#!/bin/bash
set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m'

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Config Generator${NC}"
echo -e "${GREEN}========================================${NC}"

ENV_FILE="$PROJECT_ROOT/compose/.env"

# Check if .env exists
if [ ! -f "$ENV_FILE" ]; then
    echo -e "${RED}✗ $ENV_FILE not found!${NC}"
    echo -e "${YELLOW}Create it from .env.example:${NC}"
    echo -e "  cp .env.example .env"
    echo -e "  nano .env"
    exit 1
fi

echo -e "${BLUE}Loading environment variables...${NC}"

while IFS='=' read -r key value; do
    [[ "$key" =~ ^#.*$ ]] && continue
    [[ -z "$key" ]] && continue
    
    key=$(echo "$key" | sed 's/^[[:space:]]*//;s/[[:space:]]*$//')
    value=$(echo "$value" | sed 's/^[[:space:]]*//;s/[[:space:]]*$//')
    
    # Remove quotes
    value="${value%\"}"
    value="${value#\"}"
    value="${value%\'}"
    value="${value#\'}"
    
    export "$key=$value"
done < <(grep -v '^#' "$ENV_FILE" | grep -v '^$')

export APP_DOMAIN="${APP_SUBDOMAIN}.${BASE_DOMAIN}"
export API_DOMAIN="${API_SUBDOMAIN}.${BASE_DOMAIN}"
export MEDIA_DOMAIN="${MEDIA_SUBDOMAIN}.${BASE_DOMAIN}"
export MINIO_CONSOLE_DOMAIN="${MINIO_CONSOLE_SUBDOMAIN}.${BASE_DOMAIN}"

export MINIO_API_URL="http://minio:9000"

# URLs
export APP_URL="https://${APP_DOMAIN}"
export VITE_API_URL="https://${API_DOMAIN}"
export AWS_URL="https://${MEDIA_DOMAIN}"
export VITE_APP_S3_URL="https://${MEDIA_DOMAIN}"
export MINIO_CONSOLE_URL="https://${MINIO_CONSOLE_DOMAIN}"

echo -e "${GREEN}✓ Environment variables loaded${NC}"
echo -e "${YELLOW}Domains configured:${NC}"
echo -e "  • App (Vue):        ${BLUE}${APP_DOMAIN}${NC}       → https://${APP_DOMAIN}"
echo -e "  • API (Laravel):    ${BLUE}${API_DOMAIN}${NC}       → https://${API_DOMAIN}/api/..."
echo -e "  • Media (MinIO):    ${BLUE}${MEDIA_DOMAIN}${NC}     → https://${MEDIA_DOMAIN}/file.jpg"
echo -e "  • Console (MinIO):  ${BLUE}${MINIO_CONSOLE_DOMAIN}${NC} → https://${MINIO_CONSOLE_DOMAIN}"
echo ""
echo -e "${YELLOW}Internal endpoints:${NC}"
echo -e "  • MinIO API:        ${BLUE}http://minio:9000${NC}      → используется приложением для загрузки"

NGINX_DIR="$PROJECT_ROOT/nginx"
mkdir -p "$NGINX_DIR/conf.d"
mkdir -p "$NGINX_DIR/sites-enabled"

echo -e "${YELLOW}Generating nginx configurations...${NC}"

generate_config() {
  local template=$1
  local output=$2
  
  if [ ! -f "$template" ]; then
    echo -e "${RED}✗ Template not found: $template${NC}"
    return 1
  fi
  
  > "$output"
  
  while IFS= read -r line || [ -n "$line" ]; do
    local new_line="$line"
    
    for var in BASE_DOMAIN APP_SUBDOMAIN API_SUBDOMAIN MEDIA_SUBDOMAIN MINIO_CONSOLE_SUBDOMAIN MINIO_API_SUBDOMAIN APP_DOMAIN API_DOMAIN MEDIA_DOMAIN MINIO_CONSOLE_DOMAIN MINIO_API_DOMAIN APP_URL VITE_API_URL AWS_URL VITE_APP_S3_URL SSL_EMAIL SSL_RSA_KEY_SIZE; do
      local value="${!var}"
      new_line="${new_line//\$\{$var\}/$value}"
      new_line="${new_line//\$${var}/$value}"
    done
    
    echo "$new_line" >> "$output"
  done < "$template"
  
  echo -e "${GREEN}✓ Generated: $output${NC}"
}

generate_config "$NGINX_DIR/templates/nginx.conf.template" "$NGINX_DIR/nginx.conf"
generate_config "$NGINX_DIR/templates/app.conf.template" "$NGINX_DIR/sites-enabled/${APP_DOMAIN}.conf"
generate_config "$NGINX_DIR/templates/api.conf.template" "$NGINX_DIR/sites-enabled/${API_DOMAIN}.conf"
generate_config "$NGINX_DIR/templates/media.conf.template" "$NGINX_DIR/sites-enabled/${MEDIA_DOMAIN}.conf"
generate_config "$NGINX_DIR/templates/console.conf.template" "$NGINX_DIR/sites-enabled/${MINIO_CONSOLE_DOMAIN}.conf"

cat > "$PROJECT_ROOT/scripts/domains.txt" <<EOF
${APP_DOMAIN}
${API_DOMAIN}
${MEDIA_DOMAIN}
${MINIO_CONSOLE_DOMAIN}
EOF
echo -e "${GREEN}✓ Generated domains list: $PROJECT_ROOT/scripts/domains.txt${NC}"

cat > "$NGINX_DIR/env.list" <<EOF
APP_DOMAIN=${APP_DOMAIN}
API_DOMAIN=${API_DOMAIN}
MEDIA_DOMAIN=${MEDIA_DOMAIN}
MINIO_CONSOLE_DOMAIN=${MINIO_CONSOLE_DOMAIN}
MINIO_API_DOMAIN=${MINIO_API_DOMAIN}
APP_URL=${APP_URL}
VITE_API_URL=${VITE_API_URL}
AWS_URL=${AWS_URL}
VITE_APP_S3_URL=${VITE_APP_S3_URL}
SSL_EMAIL=${SSL_EMAIL}
SSL_RSA_KEY_SIZE=${SSL_RSA_KEY_SIZE}
EOF
echo -e "${GREEN}✓ Generated nginx env file: $NGINX_DIR/env.list${NC}"

echo -e "${YELLOW}Updating .env file...${NC}"

FIRST_RUN=true

update_env() {
    local key=$1
    local value=$2
    if grep -q "^${key}=" "$ENV_FILE"; then
        sed -i.bak "s|^${key}=.*|${key}=${value}|" "$ENV_FILE"
        rm -f "$ENV_FILE.bak"
    else
        if [ "$FIRST_RUN" = true ]; then
            echo "" >> "$ENV_FILE"
            FIRST_RUN=false
        fi
        echo "${key}=${value}" >> "$ENV_FILE"
    fi
}

update_env "APP_DOMAIN" "$APP_DOMAIN"
update_env "API_DOMAIN" "$API_DOMAIN"
update_env "MEDIA_DOMAIN" "$MEDIA_DOMAIN"
update_env "MINIO_CONSOLE_DOMAIN" "$MINIO_CONSOLE_DOMAIN"
update_env "MINIO_API_URL" "$MINIO_API_URL"
update_env "APP_URL" "$APP_URL"
update_env "VITE_API_URL" "$VITE_API_URL"
update_env "AWS_URL" "$AWS_URL"
update_env "VITE_APP_S3_URL" "$VITE_APP_S3_URL"
update_env "MINIO_CONSOLE_URL" "$MINIO_CONSOLE_URL"

echo -e "${GREEN}✓ .env file updated${NC}"

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Configuration generation complete!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo -e "${YELLOW}Next steps:${NC}"
echo -e "  1. Review configs: ls -la $NGINX_DIR/sites-enabled/"
echo -e "  2. Build images:   make build"
echo -e "  3. Get SSL certs:  make certs"
echo -e "  4. Start services: make up"