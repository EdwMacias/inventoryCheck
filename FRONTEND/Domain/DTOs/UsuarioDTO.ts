export class UserDTO {
    user_id;
    name;
    email;
    last_name;
    address;
    document_type_id;
    number_telephone;
    statu_id;

    constructor(usuario: usuarioDTO) {
        this.user_id = usuario.user_id;
        this.name = usuario.name;
        this.last_name = usuario.last_name;
        this.email = usuario.email;
        this.address = usuario.address;
        this.document_type_id = usuario.document_type_id;
        this.number_telephone = usuario.number_telephone;
        this.statu_id = usuario.statu_id
    }
}

interface usuarioDTO {
    user_id: number,
    name: string,
    email: string,
    last_name: string,
    address: string,
    document_type_id: string
    number_telephone: string
    statu_id: number
}