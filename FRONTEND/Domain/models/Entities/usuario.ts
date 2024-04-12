import type { documentEntity } from "./document";
import type { roleEntity } from "./role";
import type { statuEntity } from "./statu";

export interface UsuarioEntity {
    "user_id": string,
    "name": string,
    "last_name": string,
    "email": string,
    "role": roleEntity,
    "document_type": documentEntity,
    "statu": statuEntity
}