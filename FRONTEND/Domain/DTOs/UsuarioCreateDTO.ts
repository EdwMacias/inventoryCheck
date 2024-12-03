import type { UsuarioEntity } from "../Models/Entities/usuario";

export class UsuarioCreateDTO implements Partial<UsuarioEntity> {

    name?: string | undefined;
    last_name?: string | undefined;
    email?: string | undefined;
    address?: string | undefined;
    number_telephone?: string | undefined;
    document_type_id?: number | undefined;
    number_document?: string | undefined;
    gender_id?: number | undefined;

    constructor(data: UsuarioEntity | null) {
        this.name = data?.name ?? undefined;
        this.last_name = data?.last_name ?? undefined;
        this.email = data?.email ?? undefined;
        this.number_telephone = data?.number_telephone ?? undefined;
        this.document_type_id = data?.document_type_id ?? 0;
        this.number_document = data?.number_document ?? undefined;
        this.gender_id = data?.gender_id ?? 0;
        this.address = data?.address ?? undefined;
    }

    toObject() {
        return {
            name: this.name,
            last_name: this.last_name,
            email: this.email,
            number_document: this.number_document,
            document_type_id: this.document_type_id,
            number_telephone: this.number_telephone,
            gender_id: this.gender_id,
            address: this.address,
        };
    }

}