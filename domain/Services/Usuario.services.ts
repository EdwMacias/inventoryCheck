import type { LoginEntity } from "../models/LoginEntity";
import { usuarioRepository } from "~/infrastructure/repositories/Usuario.repository";

export const UsuarioService = {
    AuthenticationUser: async (Credenciales: LoginEntity) => {
        const UsuarioStore =  await usuarioRepository.AuthenticationUser(Credenciales);
        return UsuarioStore;
    }
}