// import { AuthenticationRepository } from "~/Infrastructure/Repositories/Authentication/authentication.repository";
import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware(async (to, from) => {
    const conectado = UsuarioRepository.getEstadoOfConexion();

    if (!conectado || !tokenValid() || tokenExpired()) {
        UsuarioRepository.deleteUsuarioAndConexion();
        return navigateTo("/login");
    }

})

function tokenValid() {
    const token = UsuarioRepository.getToken();
    return token != null;
}

function tokenExpired() {
    const exp = UsuarioRepository.getExpire();
    const tiempoActual = Math.floor(Date.now() / 1000);
    return exp < tiempoActual;
}