import type { IEquipoObservacionDTO } from "./IEquipoObservacionDTO";


export class EquipoObservacionCreateDTO implements IEquipoObservacionDTO {

    equipoId: number | undefined;
    fecha: string;
    asunto: string;
    actividad: string;
    estado: string;
    responsable: string;
    firmaResponsable: File | undefined;
    proximaActividad: string;
    resource: File[];

    constructor(equipoObservacion: IEquipoObservacionDTO | null) {
        this.equipoId = equipoObservacion?.equipoId || undefined;
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
        // const fields: Record<string, any> = { ...this };
        if (this.equipoId) {
            formData.append('equipo_id', String(this.equipoId));
        }
        formData.append('fecha', this.fecha);
        formData.append('asunto', this.asunto);
        formData.append('estado', this.estado);
        formData.append('responsable', this.responsable);
        formData.append('proxima_actividad', this.proximaActividad);

        // if (this.actividad != '0') {
        formData.append('actividad', this.actividad);
        // }

        if (this.firmaResponsable) {
            formData.append('firma_responsable', this.firmaResponsable);
        }

        this.resource.forEach((element, index) => {
            formData.append(`resource[${index}]`, element);
        });

        return formData;
    }
}