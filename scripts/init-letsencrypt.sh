#!/bin/bash
set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Let's Encrypt Certificate Generator${NC}"
echo -e "${GREEN}========================================${NC}"

if [ ! -f ./scripts/domains.txt ]; then
    echo -e "${RED}✗ domains.txt not found! Run 'make generate' first.${NC}"
    exit 1
fi

DOMAINS=($(cat ./scripts/domains.txt))
EMAIL=$(grep SSL_EMAIL .env | cut -d '=' -f2)

echo -e "${YELLOW}Domains:${NC}"
for DOMAIN in "${DOMAINS[@]}"; do
    echo -e "  • ${DOMAIN}"
done
echo ""

# Create certbot webroot directory
mkdir -p ./nginx/certbot-www

# Temporary Nginx config for ACME challenge
cat > ./nginx/sites-enabled/temp-acme.conf <<EOF
server {
    listen 80;
    server_name $(IFS=' '; echo "${DOMAINS[*]}");
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
    location / {
        return 404;
    }
}
EOF

echo -e "${YELLOW}Restarting Nginx with temporary config...${NC}"
docker-compose restart nginx
sleep 5

echo -e "${YELLOW}Generating certificates...${NC}"

for DOMAIN in "${DOMAINS[@]}"; do
    echo -e "${GREEN}Processing: $DOMAIN${NC}"
    
    docker-compose run --rm --entrypoint "\
      certbot certonly \
        --webroot \
        -w /var/www/certbot \
        -d $DOMAIN \
        --email $EMAIL \
        --rsa-key-size 4096 \
        --agree-tos \
        --non-interactive" certbot
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Certificate generated for $DOMAIN${NC}"
    else
        echo -e "${RED}✗ Failed to generate certificate for $DOMAIN${NC}"
    fi
done

# Remove temporary config
rm -f ./nginx/sites-enabled/temp-acme.conf

echo -e "${YELLOW}Restarting Nginx with SSL configs...${NC}"
docker-compose restart nginx

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}  Certificates generated successfully!${NC}"
echo -e "${GREEN}========================================${NC}"