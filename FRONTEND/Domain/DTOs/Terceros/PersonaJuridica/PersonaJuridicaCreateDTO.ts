import type { PersonaJuridica } from "./PersonaJuridica";

export class PersonaJuridicaCreateDTO implements Partial<PersonaJuridica> {
    razonSocial: string;
    nit: string;
    tipoEntidad?: string | null;
    fechaRegistroCamara?: string | null; // Assuming ISO format for the date
    numeroRegistro?: string | null;
    pais?: string | null;
    representanteLegal?: string | null;
    telefono: string;
    email: string;

    constructor(personaJuridica: Partial<PersonaJuridicaCreateDTO> = {}) {
        this.razonSocial = personaJuridica.razonSocial || "";
        this.nit = personaJuridica.nit || "";
        this.tipoEntidad = personaJuridica.tipoEntidad || null;
        this.fechaRegistroCamara = personaJuridica.fechaRegistroCamara || null;
        this.numeroRegistro = personaJuridica.numeroRegistro || null;
        this.pais = personaJuridica.pais || 'Colombia';
        this.representanteLegal = personaJuridica.representanteLegal || null;
        this.telefono = personaJuridica.telefono || "";
        this.email = personaJuridica.email || "";
    }

    toArray(): Record<string, any> {
        return {
            razonSocial: this.razonSocial,
            nit: this.nit,
            tipoEntidad: this.tipoEntidad,
            fechaRegistroCamara: this.fechaRegistroCamara,
            numeroRegistro: this.numeroRegistro,
            pais: this.pais,
            representanteLegal: this.representanteLegal,
            telefono: this.telefono,
            email: this.email,
        };
    }
}
