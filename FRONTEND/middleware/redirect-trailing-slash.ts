export default defineNuxtRouteMiddleware((to, from) => {
    //     if (to.params.id == 'editar' || to.params.id == 'crear') {

    //         if (to.params.id == 'editar' && !to.query.id) {
    //             return navigateTo('/error');
    //         }

    //         if (to.params.id == 'crear' && Object.keys(to.query).length != 0) {
    //             return navigateTo('/error');
    //         }

    //         if (to.path !== '/' && to.path.endsWith('/')) {
    //             const newPath = to.path.slice(0, -1);
    //             return navigateTo(newPath, { redirectCode: 301 });
    //         }
    //         return;
    //     }

    if (to.path !== '/' && !to.path.endsWith('/')) {
        const { path, query, hash } = to;
        const nextPath = path + '/';
        const nextRoute = { path: nextPath, query, hash };
        return navigateTo(nextRoute, { redirectCode: 301 });
    }


})
