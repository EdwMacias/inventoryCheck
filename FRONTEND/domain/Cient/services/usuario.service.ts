import type { LoginRequest } from "~/Domain/Models/Api/Request/login.request.model";
import type { UsuarioInterface } from "~/Domain/Models/Entities/usuario.entity";
import { http } from "~/Infrastructure/http/http";

export const UsuarioServices = {

    Login: async (credenciales: LoginRequest) => {
        const response = await http.post<UsuarioInterface>("/auth/login", credenciales);
        return response;
    },

    Logout: async () => {
        const response = await http.post<boolean>('/auth/logout');
        return response;
    },

    CreateUser: async () => {

        return "Usuari Creado"
    },



}