import type { EquipoRequestCreate } from "../Models/Api/Request/equipo.request";
import type { ItemBasicoRequest } from "../Models/Api/Request/itemBasico.request";

export class ItemBasicoRequestCreateDTO implements ItemBasicoRequest {
    name: string;
    serie_lote: string;
    category_id: number;
    valor_adquisicion: string;
    resource: any;

    constructor(data: any) {
        this.name = data.name;
        this.serie_lote = data.serie_lote;
        this.valor_adquisicion = data.valor_adquisicion;
        this.category_id = 2;
        this.resource = data.resource;
    }
}