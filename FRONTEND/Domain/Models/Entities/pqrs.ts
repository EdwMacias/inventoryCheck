export interface Pqrs {
    name?: string,
    option: string,
    descriptionPQRS: string,
}

export class PqrsEntity {
    name?: string;
    option: string;
    descriptionPQRS: string;

    constructor(pqrs: Pqrs | null) {
        this.name = pqrs?.name ?? '';
        this.option = pqrs?.option ?? "0";
        this.descriptionPQRS = pqrs?.descriptionPQRS ?? '';
    }

    toFormData() {
        const formData = new FormData();
        formData.append('name', this.name ?? '');
        formData.append('opcion', this.option ?? '');
        formData.append('descriptionPQRS', this.descriptionPQRS ?? '');
        return formData;
    }
}