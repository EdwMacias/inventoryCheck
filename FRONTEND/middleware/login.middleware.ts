import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware(() => {
    const conectado = UsuarioRepository.getEstadoOfConexion();

    if (import.meta.browser) {
        if (conectado && tokenValid() == false && tokenExpired() == false) {
            return navigateTo("/")
        }
    }

    if (conectado && tokenValid() == false && tokenExpired() == false) {
        return navigateTo("/")
    }

})

function tokenValid() {
    const token = UsuarioRepository.getToken();
    return token == null;
}

function tokenExpired() {
    const exp = UsuarioRepository.getExpire();
    const tiempoActual = Math.floor(Date.now() / 1000);
    return exp < tiempoActual;
}