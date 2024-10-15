import { SerialCodeRepository } from "~/Infrastructure/Repositories/SerialCodes/SerialCodes.repository";

export interface FormularioItemBasicoDTO {
    name: string;
    serie_lote: string;
    valor_adquisicion: string;
    images: File[]; // Asumiendo que las imágenes serán de tipo File
}

export class FormularioCreateItemBasicoDTO implements FormularioItemBasicoDTO {
    name: string;
    serie_lote: string;
    categoriaItem: string;
    valor_adquisicion: string;
    images: File[];

    constructor(formulario: FormularioItemBasicoDTO | null) {
        this.name = formulario?.name ?? '';
        this.serie_lote = formulario?.serie_lote ?? '0';
        this.valor_adquisicion = formulario?.valor_adquisicion ?? '';
        this.images = formulario?.images ?? [];
        this.categoriaItem = '0';

    }

    toFormData(): FormData {


        const formData = new FormData();

        formData.append('name', this.name);
        formData.append('category_id', '2');
        formData.append('serie_lote', SerialCodeRepository.getCodeById(this.serie_lote) ?? '');
        formData.append('valor_adquisicion', this.valor_adquisicion.toString());

        this.images.forEach((image, index) => {
            formData.append(`resource[${index}]`, image);
        });

        return formData;
    }

}