import { array, object } from "yup";
import type { EquipoRequestCreate } from "../Models/Api/Request/equipo.request";
import type { componentes, EquipoEntity } from "../Models/Entities/equipo";

export class EquipoRequestCreateDTO implements EquipoEntity {
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
    valor_adquisicion: string;
    numero_factura?: string | null;
    frecuencia_verificacion: string;
    category_id: number;
    procedimiento_verificacion: string;
    frecuencia_calibracion: string;
    fecha_calibracion_actual?: string | null;
    fecha_proxima_calibracion?: string | null;
    maxima_incertidumbre_calibracion?: string | null;
    proveedor_calibracion?: string | null;
    contacto_calibracion?: string | null;
    email_calibracion?: string | null;
    telefono_calibracion?: string | null;
    resource: any;
    cond_electrica: boolean;
    cond_mecanica: boolean;
    cond_seguridad: boolean;
    cond_ambientales: boolean;
    cond_transporte: boolean;
    cond_otras: boolean;
    componentes: componentes[];

    constructor(data: any) {
        this.name = data.name;
        this.fabricante = data.fabricante;
        this.modelo = data.modelo;
        this.marca = data.marca;
        this.serie_lote = data.serie_lote;
        this.activo_fijo = data.activo_fijo;
        this.ubicacion = data.ubicacion;
        this.ficha_tecnica = data.ficha_tecnica;
        this.manual = data.manual;
        this.garantia = data.garantia;
        this.instruc_operacion = data.instruc_operacion;
        this.periodicidad_calibracion = data.periodicidad_calibracion;
        this.periodicidad_verificacion = data.periodicidad_verificacion;
        this.proveedor = data.proveedor;
        this.contacto_proveedor = data.contacto_proveedor;
        this.telefono_proveedor = data.contacto_proveedor;
        this.email_proveedor = data.email_proveedor;
        this.resolucion = data.resolucion;
        this.clase_exactitud = data.clase_exactitud;
        this.rango_medicion = data.rango_medicion;
        this.intervalo_medicion = data.intervalo_medicion;
        this.error_maximo_permitido = data.error_maximo_permitido;
        this.fecha_adquisicion = data.fecha_adquisicion;
        this.valor_adquisicion = data.valor_adquisicion;
        this.numero_factura = data.numero_factura;
        this.frecuencia_verificacion = data.frecuencia_verificacion;
        this.category_id = 1;
        this.procedimiento_verificacion = data.procedimiento_verificacion;
        this.frecuencia_calibracion = data.frecuencia_calibracion;
        this.fecha_calibracion_actual = data.fecha_calibracion_actual;
        this.fecha_proxima_calibracion = data.fecha_proxima_calibracion;
        this.maxima_incertidumbre_calibracion = data.maxima_incertidumbre_calibracion;
        this.proveedor_calibracion = data.proveedor_calibracion;
        this.contacto_calibracion = data.contacto_calibracion;
        this.email_calibracion = data.email_calibracion;
        this.telefono_calibracion = data.telefono_calibracion;
        this.resource = data.resource;
        this.cond_electrica = data.cond_electrica;
        this.cond_mecanica = data.cond_mecanica;
        this.cond_seguridad = data.cond_seguridad;
        this.cond_ambientales = data.cond_ambientales;
        this.cond_transporte = data.cond_transporte;
        this.cond_otras = data.cond_otras;
        this.componentes = data.componentes;
    }

    toFormData(): FormData {
        const formData = new FormData();

        Object.entries(this).forEach(([key, value]) => {
            if (value && !Array.isArray(value)) {
                formData.append(key, value);
            }
        });

        this.componentes.forEach((values, index) => {
            formData.append(`componentes[${index}]`, JSON.stringify(values));
        })

        return formData;
    }
}