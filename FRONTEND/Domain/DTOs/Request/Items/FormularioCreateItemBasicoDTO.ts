export interface FormularioItemBasicoDTO {
    name: string;
    seccion: string;
    valor_adquisicion: string;
    images: File[]; // Asumiendo que las imágenes serán de tipo File
}

export class FormularioCreateItemBasicoDTO implements FormularioItemBasicoDTO {
    name: string;
    seccion: string;
    valor_adquisicion: string;
    images: File[];

    constructor(formulario: FormularioItemBasicoDTO) {
        this.name = formulario.name;
        this.seccion = formulario.seccion;
        this.valor_adquisicion = formulario.valor_adquisicion;
        this.images = formulario.images;
    }

    toFormData(): FormData {
        const formData = new FormData();

        formData.append('name', this.name);
        formData.append('seccion', this.seccion);
        formData.append('valor_adquisicion', this.valor_adquisicion.toString());

        this.images.forEach((image, index) => {
            formData.append(`images[${index}]`, image);
        });

        return formData;
    }

}