import type { PersonaJuridica } from "./PersonaJuridica";

export class PersonaJuridicaDTO implements Partial<PersonaJuridica> {
    id: number;
    razonSocial: string;
    nit: string;
    tipoEntidad?: string | null;
    fechaRegistroCamara?: string | null; // Puede ser Date si el dato se maneja como tal
    numeroRegistro?: string | null;
    pais?: string | null;
    representanteLegal?: string | null;
    telefono: string;
    email: string;
    createdAt?: string | null; // Puede ser Date si el dato se maneja como tal
    updatedAt?: string | null;

    constructor(personaJuridica: Partial<PersonaJuridicaDTO>) {
        this.id = personaJuridica?.id ?? 0;
        this.razonSocial = personaJuridica?.razonSocial ?? '';
        this.nit = personaJuridica?.nit ?? '';
        this.tipoEntidad = personaJuridica?.tipoEntidad ?? null;
        this.fechaRegistroCamara = personaJuridica?.fechaRegistroCamara ?? null;
        this.numeroRegistro = personaJuridica?.numeroRegistro ?? null;
        this.pais = personaJuridica?.pais ?? null;
        this.representanteLegal = personaJuridica?.representanteLegal ?? null;
        this.telefono = personaJuridica?.telefono ?? '';
        this.email = personaJuridica?.email ?? '';
        this.createdAt = personaJuridica?.createdAt ?? null;
        this.updatedAt = personaJuridica?.updatedAt ?? null;
    }
}
