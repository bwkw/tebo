FROM node:16-slim

WORKDIR /client
COPY ./client/package* ./
RUN npm install
COPY ./client/ ./
CMD ["npm", "run", "dev"]
