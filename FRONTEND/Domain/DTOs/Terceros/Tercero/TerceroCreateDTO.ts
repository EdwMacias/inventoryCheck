interface TerceroCreateDTO {
    tipoDocumentoId: number | string | null;
    numeroDocumento: string | null;
    tipoPersonaId: number | string | null;
    razonSocial: string | null;
    primerNombre: string | null;
    segundoNombre: string | null;
    primerApellido: string | null;
    segundoApellido: string | null;
    email: string | null;
    direccion: string | null;
    ciudad: string | null;
    departamento: string | null;
    pais: string | null;
    telefono: string | null;
    foto: string | null;
}

export class TerceroCreate {
    tipoDocumentoId: number | string | null;
    numeroDocumento: string | null;
    tipoPersonaId: number | string | null;
    razonSocial: string | null;
    primerNombre: string | null;
    segundoNombre: string | null;
    primerApellido: string | null;
    segundoApellido: string | null;
    email: string | null;
    direccion: string | null;
    ciudad: string | null;
    departamento: string | null;
    pais: string | null;
    telefono: string | null;
    foto: string | null;

    constructor(data: Partial<TerceroCreateDTO> = {}) {
        this.tipoDocumentoId = data.tipoDocumentoId ?? '';
        this.numeroDocumento = data.numeroDocumento ?? null;
        this.tipoPersonaId = data.tipoPersonaId ?? null;
        this.razonSocial = data.razonSocial ?? null;
        this.primerNombre = data.primerNombre ?? null;
        this.segundoNombre = data.segundoNombre ?? null;
        this.primerApellido = data.primerApellido ?? null;
        this.segundoApellido = data.segundoApellido ?? null;
        this.email = data.email ?? null;
        this.direccion = data.direccion ?? null;
        this.ciudad = data.ciudad ?? null;
        this.departamento = data.departamento ?? null;
        this.pais = data.pais ?? null;
        this.telefono = data.telefono ?? null;
        this.foto = data.foto ?? null;
    }
}
