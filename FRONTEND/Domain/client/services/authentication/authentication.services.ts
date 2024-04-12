import type { LoginRequest } from "@/Domain/Models/Api/Request/login.request.model";
import { AuthenticationRepository } from "~/Infrastructure/Repositories/Authentication/authentication.repository";

export const AuthenticationServices = {

    Login: async (credenciales: LoginRequest) => {
        const response = await AuthenticationRepository.getToken(credenciales);
        return response;
    },

    Logout: async () => {
        const response = await AuthenticationRepository.deleteToken();
        return response;
    },

    Refresh: async () => {
        const response = await AuthenticationRepository.updateToken();
        return response;
    }

}