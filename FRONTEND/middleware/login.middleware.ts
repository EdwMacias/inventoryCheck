import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware((to, from) => {
    const conectado = UsuarioRepository.getEstadoOfConexion();        
    if (process.server) {
        if (conectado) {
            return navigateTo("/")
        }
    }
})
