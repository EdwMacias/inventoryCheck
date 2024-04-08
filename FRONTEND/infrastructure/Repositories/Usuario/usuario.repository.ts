import type { UsuarioEntity } from "~/Domain/Models/Entities/usuario.entity";

export const UsuarioRepository = {

    getUsuario: (): UsuarioEntity | undefined => {
        const usuario = UsuarioStore();
        return usuario.usuario;
    },

    getToken: (): string | null => {
        return getFromLocalStorage("access_token");
    },

    getEstadoOfConexion: (): boolean => {
        const usuario = UsuarioStore();
        return usuario.conectado;
    },

    saveUsuario: (usuario: UsuarioEntity) => {
        const usuarioStore = UsuarioStore();
        usuarioStore.setUsuario(usuario);
    },

    saveToken: (token: string) => {
        saveToLocalStorage('access_token', token)
    },

    saveEstadoConectado: (statu: boolean) => {
        const usuarioStore = UsuarioStore();
        usuarioStore.setConectado(statu);
    }
}