export interface Unidad {
    unidadId: number;
    nombre: string;
    codigo: string;
}

export interface Oficina {
    itemBasicoId: number;
    itemId: string;
    nombre: string;
    serial: string;
    valor: string;
    unidad: Unidad;
    cantidad: string;
    imagen: string;
    createdAt: string; // ISO date string
    updatedAt: string; // ISO date string
}
