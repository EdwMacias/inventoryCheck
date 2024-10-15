import type { ObservacionRequestItem } from "~/Domain/Models/Entities/ObservacionItem";

export class ItemOficinaObservacionDTO implements ObservacionRequestItem {
    itemId: string;
    fecha: string;
    userId?: string | undefined;
    observacion: string;
    tipoObservacionId: string;
    resources?: File[] | undefined;

    constructor(observacion: ObservacionRequestItem | null) {
        this.itemId = observacion?.itemId || '';
        this.fecha = observacion?.fecha || new Date().toISOString().split('T')[0];
        this.observacion = observacion?.observacion || '';
        this.tipoObservacionId = observacion?.tipoObservacionId || "0";
        this.resources = this.resources || [];
    }

    toFormData() {
        const formData = new FormData();

        formData.append('itemId', this.itemId);
        formData.append('fecha', this.fecha);
        formData.append('observacion', this.observacion);

        formData.append('tipoObservacionId', '4');

        if (this.resources && this.resources.length > 0) {
            this.resources.forEach((file, index) => {
                if (file instanceof File) {
                    formData.append(`resources[${index}]`, file);
                }
            })
        }

        return formData;

    }


}