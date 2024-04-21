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

    getUsuarioByEmail: async (email: string) => {
        const response = await http.get<UsuarioEntity>('user/get/' + email);
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
    createUsuario: (usuario: UsuarioEntity) => {
        const response = http.post<UsuarioEntity>("user/create", usuario);
        return response;
    },
    deleteUsuario: () => {
        const response = http.delete<UsuarioEntity>("eliminar");
        return response;
    },
    updateUsuario: (id: number, usuario: UsuarioEntity) => {
        const response = http.post<UsuarioEntity>("user/update/" + id, usuario);
        return response;
    }
}