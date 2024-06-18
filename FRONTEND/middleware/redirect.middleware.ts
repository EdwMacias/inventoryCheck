export default defineNuxtRouteMiddleware((to, from) => {
    if (to.params.id === '/') {
        setTimeout(() => {
            navigateTo('/inventario/items/')
          }, 3000)
    }
  })