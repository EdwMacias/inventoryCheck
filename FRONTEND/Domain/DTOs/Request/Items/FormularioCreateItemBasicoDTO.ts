export interface FormularioItemBasicoDTO {
    name: string;
    serie_lote: string;
    valor_adquisicion: number;
    images: File[]; // Asumiendo que las imágenes serán de tipo File
}

export class FormularioCreateItemBasicoDTO implements FormularioItemBasicoDTO {
    name: string;
    serie_lote: string;
    valor_adquisicion: number;
    images: File[];

    constructor(formulario: FormularioItemBasicoDTO) {
        this.name = formulario.name;
        this.serie_lote = formulario.serie_lote;
        this.valor_adquisicion = formulario.valor_adquisicion;
        this.images = formulario.images;
    }

    toFormData(): FormData {
        const formData = new FormData();

        formData.append('name', this.name);
        formData.append('serie_lote', this.serie_lote);
        formData.append('valor_adquisicion', this.valor_adquisicion.toString());

        this.images.forEach((image, index) => {
            formData.append(`images[${index}]`, image);
        });

        return formData;
    }

}