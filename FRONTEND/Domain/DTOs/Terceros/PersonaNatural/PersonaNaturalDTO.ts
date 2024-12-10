import type { documentEntity } from "~/Domain/Models/Entities/document";
import type { PersonaNatural } from "./PersonaNatural";

export class PersonaNaturalDTO implements PersonaNatural {
    
    personaNaturalId?: number | null;
    primerNombre: string;
    segundoNombre: string;
    primerApellido: string;
    segundoApellido: string;
    tipoIdentificacion: string;
    numeroIdentificacion: string;
    telefono: string;
    correo: string;
    direccion: string;
    departamento: string;
    ciudad: string;
    dv?: string | null;
    createdAt?: string | null; // Puede ser Date si el dato se maneja como tal
    updatedAt?: string | null;
    documento: Pick<documentEntity, "name">;

    constructor(personaNatural: Partial<PersonaNatural>) {
        this.personaNaturalId = personaNatural?.personaNaturalId ?? null;
        this.primerNombre = personaNatural?.primerNombre ?? '';
        this.segundoNombre = personaNatural?.segundoNombre ?? '';
        this.primerApellido = personaNatural?.primerApellido ?? '';
        this.segundoApellido = personaNatural?.segundoApellido ?? '';
        this.tipoIdentificacion = personaNatural?.tipoIdentificacion ?? '';
        this.numeroIdentificacion = personaNatural?.numeroIdentificacion ?? '';
        this.telefono = personaNatural?.telefono ?? '';
        this.correo = personaNatural?.correo ?? '';
        this.direccion = personaNatural?.direccion ?? '';
        this.departamento = personaNatural?.departamento ?? '';
        this.ciudad = personaNatural?.ciudad ?? '';
        this.dv = personaNatural?.dv ?? null;
        this.documento = personaNatural.documento ?? { name: '' };
        this.createdAt = personaNatural?.createdAt ?? null;
        this.updatedAt = personaNatural?.updatedAt ?? null;

    }

}

