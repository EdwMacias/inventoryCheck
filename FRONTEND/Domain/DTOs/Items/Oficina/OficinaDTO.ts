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
        this.itemBasicoId = oficina.itemBasicoId;
        this.itemId = oficina.itemId;
        this.nombre = oficina.nombre;
        this.serial = oficina.serial;
        this.valor = oficina.valor;
        this.unidad = oficina.unidad;
        this.cantidad = oficina.cantidad;
        this.imagen = oficina.imagen;
        this.createdAt = oficina.createdAt;
        this.updatedAt = oficina.updatedAt;
    }

}