FROM node:20.13.1-alpine3.20 as base

FROM base as build-stage

WORKDIR /app/
COPY package*.json .
RUN npm install

COPY . .
RUN npm run build

FROM base
WORKDIR /app/
COPY --from=build-stage /app/.output/ /app/

CMD [ "node","./server/index.mjs" ]