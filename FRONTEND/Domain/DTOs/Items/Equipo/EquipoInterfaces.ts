export interface ComponenteEquipoInterface {
    id: number;
    itemId: string;
    serial: string;
    cantidad: string;
    cuidados: string;
    modelo: string;
    marca: string;
    nombre: string;
    unidad: string;
    tipo: string;
    createdAt: string;
    updatedAt: string;
}

export interface EquipoInterface {
    equipo_id: number;
    item_id: string;
    name: string;
    fabricante: string;
    modelo: string;
    marca: string;
    serie_lote: string;
    activo_fijo: string;
    ubicacion: string;
    ficha_tecnica: string;
    manual: string;
    garantia: string;
    instruc_operacion: string;
    periodicidad_calibracion: string;
    periodicidad_verificacion: string;
    proveedor: string;
    contacto_proveedor: string;
    telefono_proveedor: string;
    email_proveedor: string;
    resolucion: string;
    clase_exactitud: string;
    rango_medicion: string;
    intervalo_medicion: string;
    error_maximo_permitido: string;
    fecha_adquisicion: string;
    valor_adquisicion: string | null;
    numero_factura: string;
    frecuencia_verificacion: string;
    procedimiento_verificacion: string;
    frecuencia_calibracion: string | null;
    fecha_calibracion_actual: string;
    fecha_proxima_calibracion: string;
    maxima_incertidumbre_calibracion: string;
    proveedor_calibracion: string;
    contacto_calibracion: string;
    email_calibracion: string;
    telefono_calibracion: string;
    cond_electrica: number;
    cond_mecanica: number;
    cond_ambientales: number;
    cond_seguridad: number;
    cond_transporte: number;
    cond_otras: number;
    imagen: string;
    componentes: ComponenteEquipoInterface[];
    created_at: string;
    updated_at: string;
}
