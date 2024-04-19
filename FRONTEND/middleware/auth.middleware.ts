import { AuthenticationRepository } from "~/infrastructure/Repositories/Authentication/authentication.repository";
import { UsuarioRepository } from "~/infrastructure/Repositories/Usuario/usuario.repository";

export default defineNuxtRouteMiddleware(async (to, from) => {

    const conectado = UsuarioRepository.getEstadoOfConexion();

    if (!conectado || !tokenValid() || tokenExpired()) {
        return navigateTo("/login");
    }

    await refreshToken();

    if (process.browser) {
        setInterval(async () => {
            await refreshToken();
        }, 60000);
    }

    return;

})

async function refreshToken() {
    const token = UsuarioRepository.getToken();
    if (token) {
        const exp = UsuarioRepository.getExpire();
        if (exp - Date.now() / 1000 < 300) {
            try {
                const response = await AuthenticationRepository.updateToken();
                UsuarioRepository.saveToken(response.data.access_token);
                console.log('Token renovado correctamente.');
            } catch (error) {
                console.error('Error al renovar el token:', error);
            }
        } 
    }
}

function tokenValid() {
    const token = UsuarioRepository.getToken();
    return token != null;
}

function tokenExpired() {
    const exp = UsuarioRepository.getExpire();
    const tiempoActual = Math.floor(Date.now() / 1000);
    return exp < tiempoActual;
}