import type { LoginRequest } from "~/domain/models/Api/Request/login.request.model";
import { AuthenticationRepository } from "~/Infrastructure/Repositories/Authentication/authentication.repository";
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

        UsuarioRepository.saveToken(access_token);
        UsuarioRepository.saveEstadoConectado(true);
        
        if (usuario !== undefined) {
            UsuarioRepository.saveUsuario(usuario)
        }

        return { messages: messageSeatado, session: true };
    },

    Logout: async () => {
        // const response = await http.post<boolean>('/auth/logout');
        // return response;
    },

    CreateUser: async () => {

        return "Usuari Creado"
    },



}