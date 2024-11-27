import type { PersonaNatural } from "./PersonaNatural";

export class PersonaNaturalCreateDTO implements Partial<PersonaNatural> {
    primerNombre: string;
    segundoNombre?: string | null;
    primerApellido: string;
    segundoApellido?: string | null;
    tipoIdentificacion: string;
    numeroIdentificacion: string;
    telefono: string;
    correo?: string | null;
    direccion: string;
    departamento: string;
    ciudad: string;
    dv?: string | null;

    constructor(personaNatural: Partial<PersonaNaturalCreateDTO> = {}) {
        this.primerNombre = this.sanitizeString(personaNatural.primerNombre) ?? "";
        this.segundoNombre = this.sanitizeString(personaNatural.segundoNombre) ?? null;
        this.primerApellido = this.sanitizeString(personaNatural.primerApellido) ?? "";
        this.segundoApellido = this.sanitizeString(personaNatural.segundoApellido) ?? null;
        this.tipoIdentificacion = this.sanitizeString(personaNatural.tipoIdentificacion) ?? "";
        this.numeroIdentificacion = this.sanitizeNumber(personaNatural.numeroIdentificacion) ?? "";
        this.telefono = this.sanitizeNumber(personaNatural.telefono) ?? "";
        this.correo = this.sanitizeEmail(personaNatural.correo) ?? null;
        this.direccion = this.sanitizeString(personaNatural.direccion) ?? "";
        this.departamento = this.sanitizeString(personaNatural.departamento) ?? "";
        this.ciudad = this.sanitizeString(personaNatural.ciudad) ?? "";
        this.dv = this.sanitizeString(personaNatural.dv) ?? null;
    }

    toArray(): Record<string, any> {
        return {
            primerNombre: this.primerNombre,
            segundoNombre: this.segundoNombre,
            primerApellido: this.primerApellido,
            segundoApellido: this.segundoApellido,
            tipoIdentificacion: this.tipoIdentificacion,
            numeroIdentificacion: this.numeroIdentificacion,
            telefono: this.telefono,
            direccion: this.direccion,
            departamento: this.departamento,
            ciudad: this.ciudad,
            dv: this.dv,
            correo : this.correo
        };
    }

    private sanitizeString(value?: string | null): string | null {
        return value ? value.trim() : null;
    }

    private sanitizeNumber(value?: string | null): string | null {
        return value ? value.replace(/[^0-9]/g, "") : null;
    }

    private sanitizeEmail(value?: string | null): string | null {
        return value ? value.trim() : null;
    }
}
