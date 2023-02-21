FROM node:16-slim

WORKDIR /client
COPY ./client/package* .
RUN npm install

CMD ["npm", "run", "dev"]
