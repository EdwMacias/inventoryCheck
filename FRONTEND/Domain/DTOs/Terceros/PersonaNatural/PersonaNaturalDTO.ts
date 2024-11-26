import type { PersonaNatural } from "./PersonaNatural";

export class PersonaNaturalDTO implements PersonaNatural {
    id?: number | null;
    primerNombre: string;
    segundoNombre: string;
    primerApellido: string;
    segundoApellido: string;
    tipoIdenticacion: string;
    numeroIdentificacion: string;
    telefono: string;
    correo: string;
    direccion: string;
    departamento: string;
    ciudad: string;
    dv?: string | null;
    createdAt?: string | null; // Puede ser Date si el dato se maneja como tal
    updatedAt?: string | null;

    constructor(personaNatural: Partial<PersonaNatural>) {
        this.id = personaNatural?.id ?? null;
        this.primerNombre = personaNatural?.primerNombre ?? '';
        this.segundoNombre = personaNatural?.segundoNombre ?? '';
        this.primerApellido = personaNatural?.primerApellido ?? '';
        this.segundoApellido = personaNatural?.segundoApellido ?? '';
        this.tipoIdenticacion = personaNatural?.tipoIdenticacion ?? '';
        this.numeroIdentificacion = personaNatural?.numeroIdentificacion ?? '';
        this.telefono = personaNatural?.telefono ?? '';
        this.correo = personaNatural?.correo ?? '';
        this.direccion = personaNatural?.direccion ?? '';
        this.departamento = personaNatural?.departamento ?? '';
        this.ciudad = personaNatural?.ciudad ?? '';
        this.dv = personaNatural?.dv ?? null;
        this.createdAt = personaNatural?.createdAt ?? null;
        this.updatedAt = personaNatural?.updatedAt ?? null;
    }
}

