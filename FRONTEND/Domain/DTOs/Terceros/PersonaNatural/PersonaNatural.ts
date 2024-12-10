import type { documentEntity } from "~/Domain/Models/Entities/document";

export interface PersonaNatural {
    personaNaturalId?: number | null;
    primerNombre: string;
    segundoNombre: string | null;
    primerApellido: string;
    segundoApellido: string | null;
    tipoIdentificacion: string;
    numeroIdentificacion: string;
    telefono: string;
    correo: string | null;
    direccion: string;
    departamento: string;
    ciudad: string;
    dv?: string | null;
    createdAt?: string | null; // Puede ser Date si el dato se maneja como tal
    updatedAt?: string | null;
    documento: Pick<documentEntity, 'name'>
}