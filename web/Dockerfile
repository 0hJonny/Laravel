FROM node:alpine AS dev

WORKDIR /app

# copy dependency lists first for layer-caching
COPY package*.json ./

RUN npm install

# copy the rest of the source
# COPY . .

# Vite’s default port
EXPOSE 5173

# CMD ["npm", "run", "dev"]
CMD [ "sleep", "infinity" ]