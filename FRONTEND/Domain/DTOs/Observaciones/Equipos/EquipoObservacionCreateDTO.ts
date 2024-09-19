import type { IEquipoObservacionDTO } from "./IEquipoObservacionDTO";


export class EquipoObservacionCreateDTO implements IEquipoObservacionDTO {

    fecha: string;
    asunto: string;
    actividad: string;
    estado: string;
    responsable: string;
    firmaResponsable: File | undefined;
    proximaActividad: string;
    resource: File[];

    constructor(equipoObservacion: IEquipoObservacionDTO | null) {
        this.fecha = equipoObservacion?.fecha || new Date().toISOString().split('T')[0];
        this.asunto = equipoObservacion?.asunto || '';
        this.actividad = equipoObservacion?.actividad || '';
        this.estado = equipoObservacion?.actividad || '0';
        this.responsable = equipoObservacion?.responsable || '';
        this.firmaResponsable = equipoObservacion?.firmaResponsable;
        this.proximaActividad = equipoObservacion?.proximaActividad || '';
        this.resource = equipoObservacion?.resource || [];
    }

    toFormData(): FormData {
        const formData = new FormData();
        const fields: Record<string, any> = { ...this };

        Object.keys(fields).forEach(key => {
            const value = fields[key];

            if (value && value !== '' && value !== '0') {
                if (value instanceof File) {
                    formData.append(key, value);
                } else if (Array.isArray(value)) {
                    value.forEach((file, index) => {
                        if (file instanceof File) {
                            formData.append(`${key}[${index}]`, file);
                        }
                    });
                } else {
                    formData.append(key, String(value));
                }
            }
        });

        return formData;
    }
}