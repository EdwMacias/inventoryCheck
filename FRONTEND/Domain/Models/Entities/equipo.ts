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
  contacto_proveedor: string;
  telefono_proveedor: string;
  email_proveedor: string;
  resolucion?: string | null;
  clase_exactitud?: string | null;
  rango_medicion?: string | null;
  intervalo_medicion?: string | null;
  error_maximo_permitido?: string | null;
  fecha_adquisicion: string;
  valor_adquisicion: number ;
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
}