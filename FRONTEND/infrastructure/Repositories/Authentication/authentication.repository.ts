import type { LoginRequest } from "~/Domain/Models/Api/Request/login.request.model";
import type { loginResponse } from "~/Domain/Models/Api/Response/login.response";
import { POST_LOGIN_USUARIO, POST_LOGOUT_USUARIO, POST_REFRESH_USUARIO } from "~/Infrastructure/Connections/endpoints.connection";
import { http } from "~/Infrastructure/http/http";

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