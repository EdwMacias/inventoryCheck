export class PersonaJuridicaCreateDTO {
    razonSocial: string;
    nit: string;
    tipoEntidad?: string | null;
    fechaRegistroCamara?: string | null; // Assuming ISO format for the date
    numeroRegistro?: number | null;
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
            razon_social: this.razonSocial,
            nit: this.nit,
            tipo_entidad: this.tipoEntidad,
            registro_camara_comercio: this.fechaRegistroCamara,
            numero_registro_camara_comercio: this.numeroRegistro,
            pais: this.pais,
            representante_legal: this.representanteLegal,
            telefono: this.telefono,
            email: this.email,
        };
    }
}
