// https://nuxt.com/docs/api/configuration/nuxt-config

import { Configuration } from "./config/Configuration";
const { modules } = Configuration;

export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: modules,

})