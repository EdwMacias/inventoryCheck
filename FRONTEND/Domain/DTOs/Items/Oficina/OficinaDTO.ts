import type { Oficina, Unidad } from "./OficinaInterface";

export class OficinaDTO implements Oficina {
    itemBasicoId: number;
    itemId: string;
    nombre: string;
    serial: string;
    valor: string;
    unidad: Unidad;
    cantidad: string;
    imagen: string;
    createdAt: string;
    updatedAt: string;

    constructor(oficina: Oficina) {
        this.itemBasicoId = oficina.itemBasicoId ?? null;
        this.itemId = oficina.itemId ?? null;
        this.nombre = oficina.nombre ?? null;
        this.serial = oficina.serial ?? null;
        this.valor = oficina.valor ?? null;
        this.unidad = oficina.unidad ?? { codigo: null, nombre: null, unidadId: null };
        this.cantidad = oficina.cantidad ?? null;
        this.imagen = oficina.imagen ?? null;
        this.createdAt = oficina.createdAt ?? null;
        this.updatedAt = oficina.updatedAt ?? null;
    }

}