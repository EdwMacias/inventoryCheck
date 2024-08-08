export class ObservationDTO {
    user_id;
    name;
    email;
    last_name;
    address;
    document_type_id;
    number_telephone;
    statu_id;
    role;

    constructor(observacion: ObservacionDTO) {
        this.user_id = observacion.user_id;
        this.name = observacion.name;
        this.last_name = observacion.last_name;
        this.email = observacion.email;
        this.address = observacion.address;
        this.document_type_id = observacion.document_type_id;
        this.number_telephone = observacion.number_telephone;
        this.statu_id = observacion.statu_id;
        this.role = observacion.role;
    }
}

interface ObservacionDTO {
    user_id: number,
    name: string,
    email: string,
    last_name: string,
    address: string,
    document_type_id: string
    number_telephone: string
    statu_id: number
    role?: string
}