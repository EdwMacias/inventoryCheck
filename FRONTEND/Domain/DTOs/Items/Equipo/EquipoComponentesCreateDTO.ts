import type { componentes, EquipoEntity } from "~/Domain/Models/Entities/equipo";

export class EquipoComponentesCreateDTO implements componentes {
    serial: string;
    nombre: string;
    marca: string;
    modelo: string;
    cantidad?: string | undefined;
    unidad: string;
    cuidados: string;
    tipo?: string | undefined;

    constructor(componentes: componentes | null = null) {
        this.serial = componentes?.serial ?? '';
        this.cantidad = componentes?.cantidad ?? undefined;
        this.cuidados = componentes?.cuidados ?? '';
        this.marca = componentes?.marca ?? '';
        this.modelo = componentes?.modelo ?? '';
        this.nombre = componentes?.nombre ?? '';
        this.unidad = componentes?.unidad ?? '';
        this.tipo = componentes?.tipo ?? undefined;
    }

    toString() {
        return JSON.stringify(this);
    }

}