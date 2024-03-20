import { Configuration } from "./infrastructure/config/app.config";
const { modules, pinia, app } = Configuration;

export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: modules,
  pinia: pinia,
  app: app,
  // pages: false
})