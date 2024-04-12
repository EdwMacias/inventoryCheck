import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository"

export default defineNuxtRouteMiddleware((to, from) => {

    const conectado = UsuarioRepository.getEstadoOfConexion();

    if (to.path == "/login") {
        if (conectado) {
            return navigateTo("/")
        }
        return;
    }

    if (!conectado) {
        return navigateTo("login");
    }
})
