import { http } from "~/infrastructure/http/http";
import type { UsuarioEntity } from "../../../domain/models/Entities/usuario";


const tokenKey = "access_token"

export const UsuarioRepository = {

    getUsuario: (): UsuarioEntity | undefined => {
        const usuario = UsuarioStore();
        return usuario.usuario;
    },

    getToken: (): string | null => {
        const usuario = UsuarioStore();
        if (usuario.token) {
            return usuario.token;
        }
        return null;
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
        const usuarioStore = UsuarioStore();
        usuarioStore.setToken(token);
    },

    saveEstadoConectado: (statu: boolean) => {
        const usuarioStore = UsuarioStore();
        usuarioStore.setConectado(statu);
    },

    deleteToken: () => {
        removeFromLocalStorage(tokenKey);
    },
    deleteUsuarioAndConexion: () => {
        const usuarioStore = UsuarioStore();
        usuarioStore.clearStore();
    },

    setExpire: (expire: number) => {
        const usuarioStore = UsuarioStore();
        usuarioStore.setExpire(expire)
    },
    getExpire: () => {
        const usuarioStore = UsuarioStore();
        if (usuarioStore.expire) {
            return usuarioStore.expire;
        }
        return 0;
    },
    createUsuario: () => {
        const response = http.post<UsuarioEntity>("crear");
        return response;
    },
    deleteUsuario: () => {
        const response = http.delete<UsuarioEntity>("eliminar");
        return response;
    },
    updateUsuario: () => {
        const response = http.post<UsuarioEntity>("actualizar");
        return response;
    }
}