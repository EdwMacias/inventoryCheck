import { Configuration } from "./config/Configuration";
const { modules, pinia } = Configuration;

export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: modules,
  pinia: pinia,
})