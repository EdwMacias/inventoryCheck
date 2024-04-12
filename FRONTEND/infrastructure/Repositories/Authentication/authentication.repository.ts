import type { LoginRequest } from "../../../domain/models/Api/Request/login.request.model";
import type { loginResponse } from "../../../domain/models/Api/Response/login.response";
import { POST_LOGIN_USUARIO, POST_LOGOUT_USUARIO, POST_REFRESH_USUARIO } from "../../Connections/endpoints.connection";
import { http } from "../../http/http";


export const AuthenticationRepository = {
    getToken: async (credenciales: LoginRequest) => {
        const response = await http.post<loginResponse>(POST_LOGIN_USUARIO, credenciales);
        return response;
    },

    deleteToken: async () => {
        const response = await http.post<boolean>(POST_LOGOUT_USUARIO);
        return response;
    },

    updateToken: async () => {
        const response = await http.post<loginResponse>(POST_REFRESH_USUARIO);
        return response;
    }
}