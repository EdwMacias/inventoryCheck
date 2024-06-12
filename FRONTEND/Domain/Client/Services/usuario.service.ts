import { jwtDecode } from "jwt-decode";
import type { UserDTO } from "~/Domain/DTOs/UsuarioDTO";
import type { LoginRequest } from "~/Domain/Models/Api/Request/login.request.model";
import type { UsuarioEntity } from "~/Domain/Models/Entities/usuario";
import { AuthenticationRepository } from "~/Infrastructure/Repositories/Authentication/authentication.repository";
import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";
import { DatatableStore } from "~/stores/DatatableStore";

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
    },

    statuUsuario: async (userDto: UserDTO) => {
        try {
            if (userDto.statu_id != 1) {
                await UsuarioRepository.activarUsuario(userDto.email);
            } else {
                await UsuarioRepository.inactivarUsuario(userDto.email);
            }
        } catch (error) {
            console.error('Error updating user status:', error);
            console.log(error);

        }
        const datatableStore = DatatableStore();
        // datatableStore.draw();

    }
}