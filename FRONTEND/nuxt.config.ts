export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: ['@pinia/nuxt', '@pinia-plugin-persistedstate/nuxt', '@nuxtjs/tailwindcss', [
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
  ], '@vueuse/nuxt', '@nuxt/image'],

  ssr: true,

  pinia: {
    storesDirs: ["./stores/**"]
  },

  routeRules: {
    '/': { appMiddleware: ['auth-middleware'] },
    '/login': { appMiddleware: ['login-middleware'] },
    '/usuarios/**': { appMiddleware: ['auth-middleware'] },
    '/forgot-password': { appMiddleware: ['login-middleware'] },
    '/inventario/**': { appMiddleware: ['auth-middleware'] }
  },
  

  piniaPersistedstate: {
  },

  router: {
    options: {

    }
  },

  app: {
    head: {
      title: "CEDAC Inventario",
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
      link: [{ rel: 'icon', type: 'image/x-icon', href: '/logo.ico' }],
    }
  },

  plugins: ['@/plugins/animate-css', '@/plugins/swal', '@/plugins/vue-barcode',],
  css: ['bootstrap-icons/font/bootstrap-icons.css', 'vue-multiselect/dist/vue-multiselect.min.css', 'sweetalert2/src/sweetalert2.scss', '~/assets/css/main.css'],
  compatibilityDate: '2024-08-03',
})