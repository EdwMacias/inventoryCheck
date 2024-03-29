import type { LoginEntity } from "../models/entities/login.entity";
import { usuarioRepository } from "~/infrastructure/repositories/usuario.repository";

export const UsuarioService = {
    AuthenticationUser: async (Credenciales: LoginEntity) => {
        const UsuarioStore = await usuarioRepository.AuthenticationUser(Credenciales);
        return UsuarioStore;
    },
    LogoutUser: async () => {
        const response = await usuarioRepository.LogoutUser();
        return response;
    }
}