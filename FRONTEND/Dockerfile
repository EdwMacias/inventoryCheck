FROM node:20.13.1-alpine3.20 as base

# ARG PORT 
# ENV PORT=${PORT}

# ARG URL_API_CONNECTION_BACKEND
# ENV =${URL_API_CONNECTION_BACKEND}

FROM base as build-stage

WORKDIR /app/

COPY package*.json .
RUN npm install && npm update
# RUN npm install -D sass
COPY . .
RUN npm run build

FROM base
COPY --from=build-stage /app/.output/ .

CMD [ "node","./server/index.mjs" ]