import { jwtDecode } from "jwt-decode";
import type { UsuarioCreateDTO } from "~/Domain/DTOs/UsuarioCreateDTO";
import type { UserDTO } from "~/Domain/DTOs/UsuarioDTO";
import type { LoginRequest } from "~/Domain/Models/Api/Request/login.request.model";
import type { UsuarioEntity } from "~/Domain/Models/Entities/usuario";
import { AuthenticationRepository } from "~/Infrastructure/Repositories/Authentication/authentication.repository";
import { RolesRepository } from "~/Infrastructure/Repositories/Roles/role.repository";
import { UsuarioRepository } from "~/Infrastructure/Repositories/Usuario/usuario.repository";

export const UsuarioServices = {

    Login: async (credenciales: FormData) => {
        const response = await AuthenticationRepository.getToken(credenciales);

        let { data } = response;

        const { access_token } = data;
        const { exp } = jwtDecode(access_token);
        UsuarioRepository.saveToken(access_token);
        if (exp) {
            UsuarioRepository.setExpire(exp)
        }
        const usuario = await AuthenticationRepository.me();
        const roleResponse = await RolesRepository.getRoleUser();
        UsuarioRepository.saveUsuario(usuario.data);
        UsuarioRepository.setRoleUser(roleResponse.data.name);
        UsuarioRepository.saveEstadoConectado(true);

        return;
    },

    Logout: async () => {
        const response = await AuthenticationRepository.deleteToken();
        UsuarioRepository.deleteToken();
        UsuarioRepository.deleteUsuarioAndConexion();
        return;
    },

    createUser: async (usuario: UsuarioCreateDTO): Promise<boolean> => {
        await UsuarioRepository.createUsuario(usuario.toObject());
        return true;
    },

    updateUser: async (id: number, usuario: UsuarioCreateDTO): Promise<Boolean> => {
        await UsuarioRepository.updateUsuario(id, usuario.toObject());
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
    }
}