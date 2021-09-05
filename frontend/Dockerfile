FROM node:lts-alpine

RUN npm install @vue/cli

WORKDIR /app

COPY package*.json ./

RUN npm install