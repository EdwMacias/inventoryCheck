export interface ItemEntity {
    item_id?: string,
    name: string,
    description: string,
    serial_number: string,
    resource?: File
    equipment_type: number
}

export interface SuperItemEntity {
    item_id?: string;
    name: string;
    description: string;
    serial_number: string;
    resource?: File;
    equipment_type: number;
    fabricante?: string;
    modelo?: string;
    marca?: string;
    activo_fijo?: string;
    ubicacion?: string;
    ficha_tecnica?: string;
    proveedor_venta?: string;
    contacto_proveedor_venta?: string;
    email?: string;
    manual_uso?: string;
    garantia?: string;
    instruccion_operacion?: string;
    periodicidad_calibracion?: string;
    periodicidad_verificacion?: string;
    contacto?: string;
    resolucion?: string;
    clase_exactitud?: string;
    rango_medicion?: string;
    intervalo_medicion?: string;
    error_maximo?: string;
    fecha_calibracion_actual?: string;
    fecha_proxima_calibracion?: string;
    maxima_incertidumbre?: string;
    proveedor_calibracion?: string;
    frecuencia_verificacion?: string;
    frecuencia_calibracion?: string;
    proveedor?: string;
    fecha_adquisicion?: string;
    valor_adquisicion?: string;
    persona_contacto?: string;
    telefono_email?: string;
  }