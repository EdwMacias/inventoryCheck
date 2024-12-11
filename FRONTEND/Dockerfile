FROM node:current-alpine3.21 AS base

FROM base AS build-stage

WORKDIR /app/
COPY package*.json .
RUN npm install

COPY . .
RUN npm run build

FROM base
WORKDIR /app/
COPY --from=build-stage /app/.output/ /app/
COPY server/data /app/server/data/

CMD [ "node","./server/index.mjs" ]