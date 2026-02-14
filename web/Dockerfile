# ============================================
# STAGE 1: Build Vue
# ============================================
FROM node:20-alpine AS builder

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ============================================
# STAGE 2: NGINX Production
# ============================================
FROM nginx:alpine AS production

# Копируем статику
COPY --from=builder /app/dist /usr/share/nginx/html

# Healthcheck (порт 80)
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD wget --no-verbose --tries=1 --spider http://localhost/health || exit 1

# Запускаем NGINX
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]