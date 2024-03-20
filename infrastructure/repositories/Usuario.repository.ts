import { POST_LOGIN_USER, PUT_LOGOUT_USER } from "~/infrastructure/connections/helpers/helpers.endpoints";
import { jwtDecode } from "jwt-decode";
import { http } from "~/infrastructure/http/http";
import type { LoginEntity, ResponseData, ResponseLogin } from "~/domain/models/entities/login.entity";
import type { Usuario, UsuarioStore } from "~/domain/models/entities/usuario.entity";
import { removeFromLocalStorage, saveToLocalStorage } from "~/composables/UtilWebs";
import { UsuarioStore as storeUsuario } from "~/stores/UsuarioStore";

export const usuarioRepository = {
    AuthenticationUser: async (Credenciales: LoginEntity): Promise<UsuarioStore> => {
        const response = await http.post<ResponseLogin>(POST_LOGIN_USER, Credenciales);

        const { token } = response;

        const DecodificacionUsuario: Usuario = jwtDecode(token);
        const { apellido, celular, email, estado, id, nombre } = DecodificacionUsuario;

        saveToLocalStorage("session_token_user", token)

        const UsuarioEntidad: UsuarioStore = {
            usuario: {
                apellido,
                celular,
                email,
                estado,
                id,
                nombre
            },
            conectado: true
        };

        return UsuarioEntidad;
    },
    LogoutUser: async (): Promise<boolean> => {
        const PUT_LOGOUT_USER_ID = PUT_LOGOUT_USER.replace(":id", usuarioRepository.GetIdUsuario());
        const response = await http.put<ResponseData<boolean>>(PUT_LOGOUT_USER_ID);
        removeFromLocalStorage("session_token_user");
        return response.data;
    },
    GetIdUsuario: (): string => {
        const usuarioStore = storeUsuario();
        if (usuarioStore.usuario?.id != undefined) {
            return usuarioStore.usuario.id;
        }
        return "";
    },
}