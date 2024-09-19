export interface IEquipoObservacionDTO {
    equipoId: undefined | number;
    fecha: string;
    asunto: string;
    actividad: string;
    estado: string;
    responsable: string;
    firmaResponsable: File | undefined;
    proximaActividad: string;
    resource: File[];
    [key: string]: any;

}