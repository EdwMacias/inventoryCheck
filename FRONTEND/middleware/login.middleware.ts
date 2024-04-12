import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware(() => {
    const conectado = UsuarioRepository.getEstadoOfConexion();

    if (conectado) {
        return navigateTo("/")
    }
    
})
