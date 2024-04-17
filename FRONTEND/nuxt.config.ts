
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@nuxtjs/tailwindcss',
    [
      '@vee-validate/nuxt',
      {
        autoImports: true,
        componentNames: {
          Form: 'VeeForm',
          Field: 'VeeField',
          FieldArray: 'VeeFieldArray',
          ErrorMessage: 'VeeErrorMessage',
        },
      },
    ],
  ],
  ssr: true,
  pinia: {
    storesDirs: ["./stores/**"]
  },
  routeRules: {
    '/': { appMiddleware: ['auth-middleware'] },
    '/usuarios/**': { appMiddleware: ['auth-middleware'] },
    // '/login': { appMiddleware: 'login-middleware' },
    // '/auth': { appMiddleware: 'login-middleware' }
  },
  piniaPersistedstate: {
  },
  router:{
    options: {

    }
  },
  app: {
    head: {
      title: "Chequeo Inventario",
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
      link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
    }
  },

  plugins: ['@/plugins/passive-event-listeners', '@/plugins/animate-css'],
  css: ['bootstrap-icons/font/bootstrap-icons.css', '~/assets/css/main.scss'],
})
