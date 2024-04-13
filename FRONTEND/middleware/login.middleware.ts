import { UsuarioRepository } from "~/infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware(() => {
    const conectado = UsuarioRepository.getEstadoOfConexion();
    
    if (process.browser) {
        if (conectado) {
            return navigateTo("/")
        }    
    }

    if (conectado) {
        return navigateTo("/")
    }
    
})
