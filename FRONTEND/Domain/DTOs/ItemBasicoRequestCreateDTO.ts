import type { EquipoRequestCreate } from "../Models/Api/Request/equipo.request";
import type { ItemBasicoRequest } from "../Models/Api/Request/itemBasico.request";
import type { FormularioCreateItemBasicoDTO } from "./Request/Items/FormularioCreateItemBasicoDTO";

export class ItemBasicoRequestCreateDTO implements ItemBasicoRequest {
    name: string;
    serie_lote: string;
    category_id: number;
    valor_adquisicion: number;
    resource: File[];

    constructor(data: FormularioCreateItemBasicoDTO) {
        this.name = data.name;
        this.serie_lote = data.serie_lote;
        this.valor_adquisicion = data.valor_adquisicion;
        this.resource = data.images;
        this.category_id = 2;
    }

    toFormData(): FormData {
        const formData = new FormData();

        formData.append('name', this.name);
        formData.append('serie_lote', this.serie_lote);
        formData.append('valor_adquisicion', this.valor_adquisicion.toString());
        formData.append('category_id', this.category_id.toString());

        this.resource.forEach((image, index) => {
            formData.append(`resource[${index}]`, image);
        });

        return formData;
    }
}