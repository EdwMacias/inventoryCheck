import type { UsuarioEntity } from "../../Entities/usuario"

export interface loginResponse {
    access_token: string,
    token_type: string,
    expires_in: string
    usuario?: UsuarioEntity
}