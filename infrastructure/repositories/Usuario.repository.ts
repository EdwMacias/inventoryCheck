import { POST_LOGIN } from "~/connections/helpers/AllEndpoints";
import { jwtDecode } from "jwt-decode";
import { http } from "~/infrastructure/http/http";
import type { LoginEntity, ResponseLogin } from "~/domain/models/Entities/Login";
import type { Usuario, UsuarioStore } from "~/domain/models/Entities/Usuario";

export const usuarioRepository = {

    AuthenticationUser: async (Credenciales: LoginEntity): Promise<UsuarioStore> => {
        const response = await http.post<ResponseLogin>(POST_LOGIN, Credenciales);
        const { token } = response;

        const DecodificacionUsuario: Usuario = jwtDecode(token);
        const { apellido, celular, email, estado, id, nombre } = DecodificacionUsuario;

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
    }

}