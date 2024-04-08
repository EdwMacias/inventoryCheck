import type { LoginRequest } from "~/Domain/Models/Api/Request/login.request.model";
import type { loginResponse } from "~/Domain/Models/Api/Response/login.response";
import { http } from "~/Infrastructure/http/http";

export const AuthenticationRepository = {
    getToken: async (credenciales: LoginRequest) => {
        const response = await http.post<loginResponse>("auth/login", credenciales);
        return response; 
    },

    deleteToken: async () => {
        const response = await http.post<boolean>('auth/logout');
        return response;
    },

    updateToken: async () => {
        const response = await http.post<loginResponse>("auth/refresh");
        return response;
    }
}