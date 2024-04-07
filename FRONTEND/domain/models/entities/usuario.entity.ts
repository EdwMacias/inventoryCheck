import type { documentEntity } from "./document.entity"
import type { roleEntity } from "./role.entity"
import type { statuEntity } from "./statu.entity"

export interface UsuarioEntity {
    "user_id": string,
    "name": string,
    "last_name": string,
    "email": string,
    "role": roleEntity,
    "document_type": documentEntity,
    "statu": statuEntity
}