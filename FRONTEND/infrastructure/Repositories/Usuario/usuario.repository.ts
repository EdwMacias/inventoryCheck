import type { UsuarioEntity } from "~/Domain/Models/Entities/usuario.entity";

export const UsuarioRepository = {

    getUsuario: (): UsuarioEntity | undefined => {
        const usuario = UsuarioStore();
        return usuario.usuario;
    },

    getToken: (): string | null => {
        return getFromLocalStorage("session_token_user");
    },

    getEstadoOfConexion: (): boolean => {
        const usuario = UsuarioStore();
        return usuario.conectado;
    }

}