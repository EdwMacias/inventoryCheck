import { Configuration } from "./infrastructure/config/app.config";
const { modules, pinia, app } = Configuration;

export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@nuxtjs/tailwindcss',
    [
      '@vee-validate/nuxt',
      {
        // disable or enable auto imports
        autoImports: true,
        // Use different names for components
        componentNames: {
          Form: 'VeeForm',
          Field: 'VeeField',
          FieldArray: 'VeeFieldArray',
          ErrorMessage: 'VeeErrorMessage',
        },
      },
    ],
  ],
  pinia: pinia,
  app: app,
  plugins: ['@/plugins/passive-event-listeners','@/plugins/animate-css'],
  css : ['/node_modules/bootstrap-icons/font/bootstrap-icons.css'],
})
