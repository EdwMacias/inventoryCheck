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

    toFormData() {
        return toFormData(this);
    }
}