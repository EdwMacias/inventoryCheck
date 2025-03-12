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

#Para poder bajar el servidor, crear una nueva build de produccion y subir debe ejecutar los siguientes comandos uno tras otro solo cuando ya los cambios hayan sido incorporados a la carpeta FRONTEND
# docker stop cedac-frontend && docker rm cedac-frontend
# docker build --no-cache -t cedac-frotend .
# docker run -d   --name cedac-frontend   --network=scoobydoo   -p 3000:3000   --restart unless-stopped   cedac-frotend