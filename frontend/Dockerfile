FROM node:14.17.1

RUN npm install -g @vue/cli

WORKDIR /app
COPY package*.json ./

RUN npm install


COPY . .