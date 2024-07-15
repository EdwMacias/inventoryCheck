import type { ItemRequest } from "~/Domain/Models/Api/Request/item.request";
import type { ItemEntity } from "~/Domain/Models/Entities/item"
import { ItemRepository } from "~/Infrastructure/Repositories/Item/item.respository"

export const itemService = {
    create: async (itemEntity : ItemEntity) => {
        const itemRequest: ItemRequest = {
            name: itemEntity.name,
            serie_lote: itemEntity.serie_lote,
            resource: itemEntity.resource,
            fabricante: itemEntity.fabricante,
            modelo: itemEntity.modelo,
            marca: itemEntity.marca,
            activo_fijo: itemEntity.activo_fijo,
            ubicacion: itemEntity.ubicacion,
            ficha_tecnica: itemEntity.ficha_tecnica,
            manual: itemEntity.manual,
            garantia: itemEntity.garantia,
            instruc_operacion: itemEntity.instruc_operacion,
            periodicidad_calibracion: itemEntity.periodicidad_calibracion,
            periodicidad_verificacion: itemEntity.periodicidad_verificacion,
            proveedor: itemEntity.proveedor,
            contacto_proveedor: itemEntity.contacto_proveedor,
            telefono_proveedor: itemEntity.telefono_proveedor,
            email_proveedor: itemEntity.email_proveedor,
            resolucion: itemEntity.resolucion ?? null,
            clase_exactitud: itemEntity.clase_exactitud ?? null,
            rango_medicion: itemEntity.rango_medicion ?? null,
            intervalo_medicion: itemEntity.intervalo_medicion ?? null,
            error_maximo_permitido: itemEntity.error_maximo_permitido ?? null,
            fecha_adquisicion: itemEntity.fecha_adquisicion,
            valor_adquisicion: itemEntity.valor_adquisicion ?? null,
            numero_factura: itemEntity.numero_factura ?? null,
            frecuencia_verificacion: itemEntity.frecuencia_verificacion,
            category_id: itemEntity.category_id,
            procedimiento_verificacion: itemEntity.procedimiento_verificacion,
            frecuencia_calibracion: itemEntity.frecuencia_calibracion,
            fecha_calibracion_actual: itemEntity.fecha_calibracion_actual ?? null,
            fecha_proxima_calibracion: itemEntity.fecha_proxima_calibracion ?? null,
            maxima_incertidumbre_calibracion: itemEntity.maxima_incertidumbre_calibracion ?? null,
            proveedor_calibracion: itemEntity.proveedor_calibracion ?? null,
            contacto_calibracion: itemEntity.contacto_calibracion ?? null,
            email_calibracion: itemEntity.email_calibracion ?? null,
            telefono_calibracion: itemEntity.telefono_calibracion ?? null,
            cond_electrica: itemEntity.cond_electrica,
            cond_mecanica: itemEntity.cond_mecanica,
            cond_seguridad: itemEntity.cond_seguridad,
            cond_ambientales: itemEntity.cond_ambientales,
            cond_transporte: itemEntity.cond_transporte,
            cond_otras: itemEntity.cond_otras
        };
    const response = await ItemRepository.Create(itemRequest);
    return response;
    },
}