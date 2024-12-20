import type { ComponenteEquipoInterface, EquipoInterface } from "./EquipoInterfaces";

export class EquipoDTO implements EquipoInterface {
    activo_fijo: string;
    clase_exactitud: string;
    componentes: ComponenteEquipoInterface[];
    cond_ambientales: number;
    cond_electrica: number;
    cond_mecanica: number;
    cond_otras: number;
    cond_seguridad: number;
    cond_transporte: number;
    contacto_calibracion: string;
    equipo_id: number;
    item_id: string;
    name: string;
    fabricante: string;
    modelo: string;
    marca: string;
    serie_lote: string;
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
    email_calibracion: string;
    telefono_calibracion: string;
    imagen: string;
    imagenBase64?: string;
    created_at: string;
    updated_at: string;


    constructor(equipo: EquipoInterface) {
        this.activo_fijo = equipo.activo_fijo;
        this.clase_exactitud = equipo.clase_exactitud;
        this.componentes = equipo.componentes;
        this.cond_ambientales = equipo.cond_ambientales;
        this.cond_electrica = equipo.cond_electrica;
        this.cond_mecanica = equipo.cond_mecanica;
        this.cond_otras = equipo.cond_otras;
        this.cond_seguridad = equipo.cond_seguridad;
        this.cond_transporte = equipo.cond_transporte;
        this.contacto_calibracion = equipo.contacto_calibracion;
        this.equipo_id = equipo.equipo_id;
        this.item_id = equipo.item_id;
        this.name = equipo.name;
        this.fabricante = equipo.fabricante;
        this.modelo = equipo.modelo;
        this.marca = equipo.marca;
        this.serie_lote = equipo.serie_lote;
        this.ubicacion = equipo.ubicacion;
        this.ficha_tecnica = equipo.ficha_tecnica;
        this.manual = equipo.manual;
        this.garantia = equipo.garantia;
        this.instruc_operacion = equipo.instruc_operacion;
        this.periodicidad_calibracion = equipo.periodicidad_calibracion;
        this.periodicidad_verificacion = equipo.periodicidad_verificacion;
        this.proveedor = equipo.proveedor;
        this.contacto_proveedor = equipo.contacto_proveedor;
        this.telefono_proveedor = equipo.telefono_proveedor;
        this.email_proveedor = equipo.email_proveedor;
        this.resolucion = equipo.resolucion;
        this.rango_medicion = equipo.rango_medicion;
        this.intervalo_medicion = equipo.intervalo_medicion;
        this.error_maximo_permitido = equipo.error_maximo_permitido;
        this.fecha_adquisicion = equipo.fecha_adquisicion;
        this.valor_adquisicion = equipo.valor_adquisicion;
        this.numero_factura = equipo.numero_factura;
        this.frecuencia_verificacion = equipo.frecuencia_verificacion;
        this.procedimiento_verificacion = equipo.procedimiento_verificacion;
        this.frecuencia_calibracion = equipo.frecuencia_calibracion;
        this.fecha_calibracion_actual = equipo.fecha_calibracion_actual;
        this.fecha_proxima_calibracion = equipo.fecha_proxima_calibracion;
        this.maxima_incertidumbre_calibracion = equipo.maxima_incertidumbre_calibracion;
        this.proveedor_calibracion = equipo.proveedor_calibracion;
        this.email_calibracion = equipo.email_calibracion;
        this.telefono_calibracion = equipo.telefono_calibracion;
        this.imagen = equipo.imagen;
        this.imagenBase64 = equipo.imagenBase64 ?? undefined;
        this.created_at = equipo.created_at;
        this.updated_at = equipo.updated_at;
    }
}