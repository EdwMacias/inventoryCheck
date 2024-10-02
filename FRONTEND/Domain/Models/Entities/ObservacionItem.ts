export interface ObservacionRequestItem {
    itemId: string,
    fecha: string,
    userId?: string,
    observacion: string,
    tipoObservacionId: string,
    resources?: File[],
}