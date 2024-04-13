import { UsuarioRepository } from "~/infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware((to, from) => {

    // if (process.server) {
    const conectado = UsuarioRepository.getEstadoOfConexion();
    if (conectado) {
        return;
    }
    return navigateTo("/login");
    // }
})
