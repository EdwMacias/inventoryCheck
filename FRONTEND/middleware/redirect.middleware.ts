import { INDEX_PAGE_INVENTARIO } from "~/Infrastructure/Paths/Paths"

export default defineNuxtRouteMiddleware((to, from) => {
    if (to.params.id === '/') {
        setTimeout(() => {
            navigateTo(INDEX_PAGE_INVENTARIO)
          }, 3000)
    }
  })