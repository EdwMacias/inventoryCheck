import { jwtDecode } from "jwt-decode";
import { object } from "yup";
import type { LoginRequest } from "~/domain/models/Api/Request/login.request.model";
import type { UsuarioEntity } from "~/domain/models/Entities/usuario";
import { AuthenticationRepository } from "~/infrastructure/Repositories/Authentication/authentication.repository";
import { UsuarioRepository } from "~/infrastructure/Repositories/Usuario/usuario.repository";

export const UsuarioServices = {

    Login: async (credenciales: LoginRequest) => {
        const response = await AuthenticationRepository.getToken(credenciales);

        let { data, messages, code } = response;

        let messageSeatado!: string;

        if (typeof messages != 'string') {
            if (messages.length > 0) {
                messageSeatado = messages[0];
            }
        } else {
            messageSeatado = messages;
        }

        if (code > 400) {
            return { messages: messageSeatado, session: false };
        }


        const { access_token, usuario } = data;
        const { exp } = jwtDecode(access_token);
        UsuarioRepository.saveToken(access_token);
        UsuarioRepository.saveEstadoConectado(true);

        if (exp) {
            UsuarioRepository.setExpire(exp)
        }

        if (usuario !== undefined) {
            UsuarioRepository.saveUsuario(usuario)
        }

        return { messages: messageSeatado, session: true };
    },

    Logout: async () => {
        const response = await AuthenticationRepository.deleteToken();
        UsuarioRepository.deleteToken();
        UsuarioRepository.deleteUsuarioAndConexion();
        return;
    },

    createUser: async (usuario: UsuarioEntity): Promise<boolean> => {
        await UsuarioRepository.createUsuario(usuario);
        return true;
    },

    updateUser: async (id: number, usuario: UsuarioEntity): Promise<Boolean> => {
        await UsuarioRepository.updateUsuario(id, usuario);
        return true;
    }


}