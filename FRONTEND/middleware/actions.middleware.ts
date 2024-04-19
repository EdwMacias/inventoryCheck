export default defineNuxtRouteMiddleware((to, from) => {
    if (to.params.id == 'crear' || to.params.id == 'editar') {
        return;
    }
    return navigateTo('error')
})
