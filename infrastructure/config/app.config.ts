export const Configuration = {
    modules: [
        '@pinia/nuxt',
        '@pinia-plugin-persistedstate/nuxt',
        '@nuxtjs/tailwindcss'
    ],
    pinia: {
        storesDirs: ["./stores/**"]
    },
    app: {
        head: {
            title: "Chequeo Inventario",
            charset: 'utf-8',
            viewport: 'width=device-width, initial-scale=1',
            link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
        }
    }
}