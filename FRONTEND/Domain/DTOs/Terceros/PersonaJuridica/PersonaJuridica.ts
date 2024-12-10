export interface PersonaJuridica {
    personaJuridicaId: number;
    razonSocial: string;
    nit: string;
    tipoEntidad?: string | null;
    fechaRegistroCamara?: string | null; // Puede ser Date si el dato se maneja como tal
    numeroRegistro?: string | null;
    pais?: string | null;
    representanteLegal?: string | null;
    telefono: string;
    correo: string;
    createdAt?: string | null; // Puede ser Date si el dato se maneja como tal
    updatedAt?: string | null;
}