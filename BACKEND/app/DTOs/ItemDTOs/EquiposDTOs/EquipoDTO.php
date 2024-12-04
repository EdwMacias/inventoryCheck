<?php

namespace App\DTOs\ItemDTOs\EquiposDTOs;

class EquipoDTO
{
    public $equipo_id;
    public $item_id;
    public $name;
    public $fabricante;
    public $modelo;
    public $marca;
    public $serie_lote;
    public $activo_fijo;
    public $ubicacion;
    public $ficha_tecnica;
    public $manual;
    public $garantia;
    public $instruc_operacion;
    public $periodicidad_calibracion;
    public $periodicidad_verificacion;
    public $proveedor;
    public $contacto_proveedor;
    public $telefono_proveedor;
    public $email_proveedor;
    public $resolucion;
    public $clase_exactitud;
    public $rango_medicion;
    public $intervalo_medicion;
    public $error_maximo_permitido;
    public $fecha_adquisicion;
    public $valor_adquisicion;
    public $numero_factura;
    public $frecuencia_verificacion;
    public $procedimiento_verificacion;
    public $frecuencia_calibracion;
    public $fecha_calibracion_actual;
    public $fecha_proxima_calibracion;
    public $maxima_incertidumbre_calibracion;
    public $proveedor_calibracion;
    public $contacto_calibracion;
    public $email_calibracion;
    public $telefono_calibracion;
    public $cond_electrica;
    public $cond_mecanica;
    public $cond_ambientales;
    public $cond_seguridad;
    public $cond_transporte;
    public $cond_otras;
    public $imagen;
    public $componentes = [];
    public $created_at;
    public $updated_at;

    public function __construct($equipo)
    {
        $this->equipo_id = $equipo->equipo_id;
        $this->item_id = $equipo->item_id;
        $this->name = $equipo->name;
        $this->fabricante = $equipo->fabricante;
        $this->modelo = $equipo->modelo;
        $this->marca = $equipo->marca;
        $this->serie_lote = $equipo->serie_lote;
        $this->activo_fijo = $equipo->activo_fijo;
        $this->ubicacion = $equipo->ubicacion;
        $this->ficha_tecnica = $equipo->ficha_tecnica;
        $this->manual = $equipo->manual;
        $this->garantia = $equipo->garantia;
        $this->instruc_operacion = $equipo->instruc_operacion;
        $this->periodicidad_calibracion = $equipo->periodicidad_calibracion;
        $this->periodicidad_verificacion = $equipo->periodicidad_verificacion;
        $this->proveedor = $equipo->proveedor;
        $this->contacto_proveedor = $equipo->contacto_proveedor;
        $this->telefono_proveedor = $equipo->telefono_proveedor;
        $this->email_proveedor = $equipo->email_proveedor;
        $this->resolucion = $equipo->resolucion;
        $this->clase_exactitud = $equipo->clase_exactitud;
        $this->rango_medicion = $equipo->rango_medicion;
        $this->intervalo_medicion = $equipo->intervalo_medicion;
        $this->error_maximo_permitido = $equipo->error_maximo_permitido;
        $this->fecha_adquisicion = $equipo->fecha_adquisicion;
        $this->valor_adquisicion = $equipo->valor_adquisicion;
        $this->numero_factura = $equipo->numero_factura;
        $this->frecuencia_verificacion = $equipo->frecuencia_verificacion;
        $this->procedimiento_verificacion = $equipo->procedimiento_verificacion;
        $this->frecuencia_calibracion = $equipo->frecuencia_calibracion;
        $this->fecha_calibracion_actual = $equipo->fecha_calibracion_actual;
        $this->fecha_proxima_calibracion = $equipo->fecha_proxima_calibracion;
        $this->maxima_incertidumbre_calibracion = $equipo->maxima_incertidumbre_calibracion;
        $this->proveedor_calibracion = $equipo->proveedor_calibracion;
        $this->contacto_calibracion = $equipo->contacto_calibracion;
        $this->email_calibracion = $equipo->email_calibracion;
        $this->telefono_calibracion = $equipo->telefono_calibracion;
        $this->cond_electrica = $equipo->cond_electrica;
        $this->cond_mecanica = $equipo->cond_mecanica;
        $this->cond_ambientales = $equipo->cond_ambientales;
        $this->cond_seguridad = $equipo->cond_seguridad;
        $this->cond_transporte = $equipo->cond_transporte;
        $this->cond_otras = $equipo->cond_otras;
        $this->imagen = (!empty($equipo->resource) && isset($equipo->resource[0])) ? url($equipo->resource[0]->resource) : null;
        $this->componentes = $equipo->componentes->transform(function ($componente) {
            return new EquipoComponenteDTO($componente);
        });
        $this->created_at = $equipo->created_at;
        $this->updated_at = $equipo->updated_at;
    }
}

