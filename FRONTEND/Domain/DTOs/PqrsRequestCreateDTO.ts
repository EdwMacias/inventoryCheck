import type { PqrsRequest } from "../Models/Api/Request/pqrs.request";

export class PqrsRequestCreateDTO implements PqrsRequest {
    name?: string;
    opcion: number;
    descriptionPQRS: string;

    constructor(data: any) {
        this.name = data.name;
        this.opcion = data.option;
        this.descriptionPQRS = data.descriptionPQRS;
    }
}