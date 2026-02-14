.PHONY: up down build generate certs renew logs shell help

# Docker Compose file location
COMPOSE_FILE := ./compose/docker-compose.yml
PROJECT_ROOT := $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

# Colors
GREEN := $(shell printf '\033[0;32m')
YELLOW := $(shell printf '\033[1;33m')
BLUE := $(shell printf '\033[0;34m')
RED := $(shell printf '\033[0;31m')
NC := $(shell printf '\033[0m')

help:
	@echo "$(GREEN)========================================$(NC)"
	@echo "$(GREEN)  Makefile Commands$(NC)"
	@echo "$(GREEN)========================================$(NC)"
	@echo "$(BLUE)make generate$(NC)     - Generate nginx configs from templates"
	@echo "$(BLUE)make build$(NC)        - Build Docker images"
	@echo "$(BLUE)make certs$(NC)        - Generate SSL certificates"
	@echo "$(BLUE)make up$(NC)           - Start all services"
	@echo "$(BLUE)make down$(NC)         - Stop all services"
	@echo "$(BLUE)make logs$(NC)         - View logs"
	@echo "$(BLUE)make shell$(NC)        - Open shell in Laravel container"
	@echo "$(BLUE)make migrate$(NC)      - Run database migrations"
	@echo "$(BLUE)make deploy$(NC)       - Full deployment"
	@echo ""

# Generate configs from templates
generate:
	@echo "$(YELLOW)Generating configs from templates...$(NC)"
	@chmod +x $(PROJECT_ROOT)/scripts/generate-configs.sh
	@cd $(PROJECT_ROOT) && ./scripts/generate-configs.sh

# Build images
build:
	@echo "$(YELLOW)Building Docker images...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) build --no-cache

# Generate SSL certificates
certs:
	@echo "$(YELLOW)Generating SSL certificates...$(NC)"
	@chmod +x $(PROJECT_ROOT)/scripts/init-letsencrypt.sh
	@cd $(PROJECT_ROOT) && ./scripts/init-letsencrypt.sh

# Renew SSL certificates
renew:
	@echo "$(YELLOW)Renewing SSL certificates...$(NC)"
	@chmod +x $(PROJECT_ROOT)/scripts/renew-certs.sh
	@cd $(PROJECT_ROOT) && ./scripts/renew-certs.sh

# Start all services
up:
	@echo "$(YELLOW)Starting services...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) up -d
	@echo "$(GREEN)Services started!$(NC)"

# Stop all services
down:
	@echo "$(YELLOW)Stopping services...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) down
	@echo "$(GREEN)Services stopped!$(NC)"

# View logs
logs:
	@docker-compose -f $(COMPOSE_FILE) logs -f

# Laravel shell
shell:
	@docker-compose -f $(COMPOSE_FILE) exec app bash

# Nginx shell
nginx-shell:
	@docker-compose -f $(COMPOSE_FILE) exec nginx bash

# Run migrations
migrate:
	@echo "$(YELLOW)Running migrations...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) exec app php artisan migrate --force
	@echo "$(GREEN)Migrations completed!$(NC)"

# Seed database
seed:
	@echo "$(YELLOW)Seeding database...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) exec app php artisan db:seed --force
	@echo "$(GREEN)Database seeded!$(NC)"

# Clear cache
cache-clear:
	@echo "$(YELLOW)Clearing cache...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) exec app php artisan config:cache
	@docker-compose -f $(COMPOSE_FILE) exec app php artisan route:cache
	@docker-compose -f $(COMPOSE_FILE) exec app php artisan view:cache
	@echo "$(GREEN)Cache cleared!$(NC)"

# Health check
health:
	@docker-compose -f $(COMPOSE_FILE) ps

# Full deployment
deploy: generate build certs up migrate cache-clear
	@echo "$(GREEN)========================================$(NC)"
	@echo "$(GREEN)  Deployment complete!$(NC)"
	@echo "$(GREEN)========================================$(NC)"

# Change domain helper
change-domain:
	@echo "$(YELLOW)Current domain: $(shell grep BASE_DOMAIN $(PROJECT_ROOT)/.env | cut -d '=' -f2)$(NC)"
	@read -p "Enter new domain (e.g., example.com): " new_domain; \
	sed -i '' 's/BASE_DOMAIN=.*/BASE_DOMAIN=$$new_domain/' $(PROJECT_ROOT)/.env 2>/dev/null || \
	sed -i 's/BASE_DOMAIN=.*/BASE_DOMAIN=$$new_domain/' $(PROJECT_ROOT)/.env; \
	echo "$(GREEN)Domain updated to: $$new_domain$(NC)"; \
	echo "$(YELLOW)Run 'make generate' to regenerate configs$(NC)"

# Validate nginx configs
validate:
	@echo "$(YELLOW)Validating nginx configs...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) exec nginx nginx -t

# Reload nginx
nginx-reload:
	@echo "$(YELLOW)Reloading nginx...$(NC)"
	@docker-compose -f $(COMPOSE_FILE) exec nginx nginx -s reload
	@echo "$(GREEN)Nginx reloaded!$(NC)"