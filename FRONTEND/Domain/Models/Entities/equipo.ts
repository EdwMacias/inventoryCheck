
export interface componentes {
  [key: string]: any; // Esto permite claves dinámicas con tipo any
  serial: string
  nombre: string
  marca: string
  modelo: string
  cantidad?: string
  unidad: string
  cuidados: string
}

export interface EquipoEntity {
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
  contacto_proveedor: null | string;
  telefono_proveedor: null | string;
  email_proveedor: string;
  resolucion?: string | null;
  clase_exactitud?: string | null;
  rango_medicion?: string | null;
  intervalo_medicion?: string | null;
  error_maximo_permitido?: string | null;
  fecha_adquisicion: string;
  valor_adquisicion: string;
  numero_factura?: string | null;
  frecuencia_verificacion: string;
  procedimiento_verificacion: string;
  frecuencia_calibracion: string;
  fecha_calibracion_actual?: string | null;
  fecha_proxima_calibracion?: string | null;
  maxima_incertidumbre_calibracion?: string | null;
  proveedor_calibracion?: string | null;
  contacto_calibracion?: string | null;
  email_calibracion?: string | null;
  telefono_calibracion?: string | null;
  resource: File | null;
  cond_electrica: boolean;
  cond_mecanica: boolean;
  cond_seguridad: boolean;
  cond_ambientales: boolean;
  cond_transporte: boolean;
  cond_otras: boolean;
  componentes: componentes[]
}

export class EquipoEntityClass implements EquipoEntity {
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
  contacto_proveedor: string | null;
  telefono_proveedor: string | null;
  email_proveedor: string;
  resolucion: string | null;
  clase_exactitud: string | null;
  rango_medicion: string | null;
  intervalo_medicion: string | null;
  error_maximo_permitido: string | null;
  fecha_adquisicion: string;
  valor_adquisicion: string;
  numero_factura: string | null;
  frecuencia_verificacion: string;
  procedimiento_verificacion: string;
  frecuencia_calibracion: string;
  fecha_calibracion_actual: string | null;
  fecha_proxima_calibracion: string | null;
  maxima_incertidumbre_calibracion: string | null;
  proveedor_calibracion: string | null;
  contacto_calibracion: string | null;
  email_calibracion: string | null;
  telefono_calibracion: string | null;
  resource: File | null;
  cond_electrica: boolean;
  cond_mecanica: boolean;
  cond_seguridad: boolean;
  cond_ambientales: boolean;
  cond_transporte: boolean;
  cond_otras: boolean;
  componentes: componentes[];

  constructor(equipo: Partial<EquipoEntity | null>) {
    this.name = equipo?.name || '';
    this.fabricante = equipo?.fabricante || '';
    this.modelo = equipo?.modelo || '';
    this.marca = equipo?.marca || '';
    this.serie_lote = equipo?.serie_lote || '';
    this.activo_fijo = equipo?.activo_fijo || '';
    this.ubicacion = equipo?.ubicacion || '';
    this.ficha_tecnica = equipo?.ficha_tecnica || '';
    this.manual = equipo?.manual || '';
    this.garantia = equipo?.garantia || '';
    this.instruc_operacion = equipo?.instruc_operacion || '';
    this.periodicidad_calibracion = equipo?.periodicidad_calibracion || '';
    this.periodicidad_verificacion = equipo?.periodicidad_verificacion || '';
    this.proveedor = equipo?.proveedor || '';
    this.contacto_proveedor = equipo?.contacto_proveedor || null;
    this.telefono_proveedor = equipo?.telefono_proveedor || null;
    this.email_proveedor = equipo?.email_proveedor || '';
    this.resolucion = equipo?.resolucion || null;
    this.clase_exactitud = equipo?.clase_exactitud || null;
    this.rango_medicion = equipo?.rango_medicion || null;
    this.intervalo_medicion = equipo?.intervalo_medicion || null;
    this.error_maximo_permitido = equipo?.error_maximo_permitido || null;
    this.fecha_adquisicion = equipo?.fecha_adquisicion || '';
    this.valor_adquisicion = equipo?.valor_adquisicion || '';
    this.numero_factura = equipo?.numero_factura || null;
    this.frecuencia_verificacion = equipo?.frecuencia_verificacion || '';
    this.procedimiento_verificacion = equipo?.procedimiento_verificacion || '';
    this.frecuencia_calibracion = equipo?.frecuencia_calibracion || '';
    this.fecha_calibracion_actual = equipo?.fecha_calibracion_actual || null;
    this.fecha_proxima_calibracion = equipo?.fecha_proxima_calibracion || null;
    this.maxima_incertidumbre_calibracion = equipo?.maxima_incertidumbre_calibracion || null;
    this.proveedor_calibracion = equipo?.proveedor_calibracion || null;
    this.contacto_calibracion = equipo?.contacto_calibracion || null;
    this.email_calibracion = equipo?.email_calibracion || null;
    this.telefono_calibracion = equipo?.telefono_calibracion || null;
    this.resource = equipo?.resource || null;
    this.cond_electrica = equipo?.cond_electrica !== undefined ? equipo?.cond_electrica : false;
    this.cond_mecanica = equipo?.cond_mecanica !== undefined ? equipo?.cond_mecanica : false;
    this.cond_seguridad = equipo?.cond_seguridad !== undefined ? equipo?.cond_seguridad : false;
    this.cond_ambientales = equipo?.cond_ambientales !== undefined ? equipo?.cond_ambientales : false;
    this.cond_transporte = equipo?.cond_transporte !== undefined ? equipo?.cond_transporte : false;
    this.cond_otras = equipo?.cond_otras !== undefined ? equipo?.cond_otras : false;
    this.componentes = equipo?.componentes || [{
      cantidad: undefined,
      serial: '',
      cuidados: '',
      marca: '',
      modelo: '',
      nombre: '',
      unidad: '',
    }];
  }
}