import { http } from "~/Infrastructure/http/http";
import type { UsuarioEntity } from "../../../Domain/Models/Entities/usuario";
import { GET_USUARIO_BY_EMAIL, POST_CREATE_USUARIO, POST_UPDATE_USUARIO, PUT_USUARIO_ACTIVAR, PUT_USUARIO_INACTIVAR } from "~/Infrastructure/Connections/endpoints.connection";

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

    getUsuarioByEmail: async (email: string) => {
        const response = await http.get<UsuarioEntity>(buildURLWithId(GET_USUARIO_BY_EMAIL, email));
        return response.data;
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
        const usuarioStore = UsuarioStore();
        usuarioStore.$reset();
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
    createUsuario: async (usuario: UsuarioEntity) => {
        const response = await http.post<UsuarioEntity>(POST_CREATE_USUARIO, usuario);
        return response;
    },

    updateUsuario: async (id: number, usuario: UsuarioEntity) => {
        const response = await http.post<UsuarioEntity>(buildURLWithId(POST_UPDATE_USUARIO, id), usuario);
        return response;
    },

    activarUsuario: async (email: string) => {
        const response = await http.put<boolean>(buildURLWithId(PUT_USUARIO_ACTIVAR, email));
        return response;
    },
    inactivarUsuario: async (email: string) => {
        const response = await http.put<boolean>(buildURLWithId(PUT_USUARIO_INACTIVAR, email));
        return response;
    }
}