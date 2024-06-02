FROM node:20.13.1-alpine3.20
RUN addgroup inventoryfrontend && adduser -S -G inventoryfrontend inventoryfrontend
USER inventoryfrontend
WORKDIR /app/
COPY --chown=inventoryfrontend package*.json .
RUN npm install
COPY --chown=inventoryfrontend . .
ENV API_URL_CONNECTION=https://unmundobonito.com
EXPOSE 3000
CMD [ "npm", "run", "dev" ]