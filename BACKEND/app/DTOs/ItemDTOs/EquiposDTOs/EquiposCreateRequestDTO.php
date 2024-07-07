<?php

namespace App\DTOs\ItemDTOs\EquiposDTOs;

class EquiposCreateRequestDTO
{
    public string $name;
    public string $fabricante;
    public string $modelo;
    public string $marca;
    public string $serie_lote;
    public string $activo_fijo;
    public string $ubicacion;
    public string $ficha_tecnica;
    public string $manual;
    public string $garantia;
    public string $instruc_operacion;
    public string $periocidad_calibracion;
    public string $periocidad_verificacion;
    public string $proveedor;
    public string $contacto_proveedor;
    public string $telefono_proveedor;
    public string $email_proveedor;
    public ?string $resolucion;
    public ?string $clase_exactitud;
    public ?string $rango_medicion;
    public ?string $intervalo_medicion;
    public ?string $error_maximo_permitido;
    public \DateTime $fecha_adquisicion;
    public ?int $valor_adquicion;
    public ?string $numero_factura;
    public string $category_id;
    public string $frecuencia_verificacion;
    public string $procedimiento_verificacion;
    public string $frecuencia_calibracion;
    public ?\DateTime $fecha_calibracion_actual;
    public ?\DateTime $fecha_proxima_calibracion;
    public ?string $maxima_incertidumbre_calibracion;
    public ?string $proveedor_calibracion;
    public ?string $contacto_calibracion;
    public ?string $email_calibracion;
    public ?string $telefono_calibracion;

    public function __construct(
        string $name,
        string $fabricante,
        string $modelo,
        string $marca,
        string $serie_lote,
        string $activo_fijo,
        string $ubicacion,
        string $ficha_tecnica,
        string $manual,
        string $garantia,
        string $instruc_operacion,
        string $periocidad_calibracion,
        string $periocidad_verificacion,
        string $proveedor,
        string $contacto_proveedor,
        string $telefono_proveedor,
        string $email_proveedor,
        ?string $resolucion,
        ?string $clase_exactitud,
        ?string $rango_medicion,
        ?string $intervalo_medicion,
        ?string $error_maximo_permitido,
        \DateTime $fecha_adquisicion,
        ?int $valor_adquicion,
        ?string $numero_factura,
        string $category_id,
        string $frecuencia_verificacion,
        string $procedimiento_verificacion,
        string $frecuencia_calibracion,
        ?\DateTime $fecha_calibracion_actual,
        ?\DateTime $fecha_proxima_calibracion,
        ?string $maxima_incertidumbre_calibracion,
        ?string $proveedor_calibracion,
        ?string $contacto_calibracion,
        ?string $email_calibracion,
        ?string $telefono_calibracion
    ) {
        $this->name = $name;
        $this->fabricante = $fabricante;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->serie_lote = $serie_lote;
        $this->activo_fijo = $activo_fijo;
        $this->ubicacion = $ubicacion;
        $this->ficha_tecnica = $ficha_tecnica;
        $this->manual = $manual;
        $this->garantia = $garantia;
        $this->instruc_operacion = $instruc_operacion;
        $this->periocidad_calibracion = $periocidad_calibracion;
        $this->periocidad_verificacion = $periocidad_verificacion;
        $this->proveedor = $proveedor;
        $this->contacto_proveedor = $contacto_proveedor;
        $this->telefono_proveedor = $telefono_proveedor;
        $this->email_proveedor = $email_proveedor;
        $this->resolucion = $resolucion;
        $this->clase_exactitud = $clase_exactitud;
        $this->rango_medicion = $rango_medicion;
        $this->intervalo_medicion = $intervalo_medicion;
        $this->error_maximo_permitido = $error_maximo_permitido;
        $this->fecha_adquisicion = $fecha_adquisicion;
        $this->valor_adquicion = $valor_adquicion;
        $this->numero_factura = $numero_factura;
        $this->category_id = $category_id;
        $this->frecuencia_verificacion = $frecuencia_verificacion;
        $this->procedimiento_verificacion = $procedimiento_verificacion;
        $this->frecuencia_calibracion = $frecuencia_calibracion;
        $this->fecha_calibracion_actual = $fecha_calibracion_actual;
        $this->fecha_proxima_calibracion = $fecha_proxima_calibracion;
        $this->maxima_incertidumbre_calibracion = $maxima_incertidumbre_calibracion;
        $this->proveedor_calibracion = $proveedor_calibracion;
        $this->contacto_calibracion = $contacto_calibracion;
        $this->email_calibracion = $email_calibracion;
        $this->telefono_calibracion = $telefono_calibracion;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['fabricante'],
            $data['modelo'],
            $data['marca'],
            $data['serie_lote'],
            $data['activo_fijo'],
            $data['ubicacion'],
            $data['ficha_tecnica'],
            $data['manual'],
            $data['garantia'],
            $data['instruc_operacion'],
            $data['periocidad_calibracion'],
            $data['periocidad_verificacion'],
            $data['proveedor'],
            $data['contacto_proveedor'],
            $data['telefono_proveedor'],
            $data['email_proveedor'],
            $data['resolucion'] ?? null,
            $data['clase_exactitud'] ?? null,
            $data['rango_medicion'] ?? null,
            $data['intervalo_medicion'] ?? null,
            $data['error_maximo_permitido'] ?? null,
            new \DateTime($data['fecha_adquisicion']),
            $data['valor_adquicion'] ?? null,
            $data['numero_factura'] ?? null,
            $data['category_id'] ?? null,
            $data['frecuencia_verificacion'] ?? null,
            $data['procedimiento_verificacion'] ?? null,
            $data['frecuencia_calibracion'] ?? null,
            isset($data['fecha_calibracion_actual']) ? new \DateTime($data['fecha_calibracion_actual']) : null,
            isset($data['fecha_proxima_calibracion']) ? new \DateTime($data['fecha_proxima_calibracion']) : null,
            $data['maxima_incertidumbre_calibracion'] ?? null,
            $data['proveedor_calibracion'] ?? null,
            $data['contacto_calibracion'] ?? null,
            $data['email_calibracion'] ?? null,
            $data['telefono_calibracion'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'fabricante' => $this->fabricante,
            'modelo' => $this->modelo,
            'marca' => $this->marca,
            'serie_lote' => $this->serie_lote,
            'activo_fijo' => $this->activo_fijo,
            'ubicacion' => $this->ubicacion,
            'ficha_tecnica' => $this->ficha_tecnica,
            'manual' => $this->manual,
            'garantia' => $this->garantia,
            'instruc_operacion' => $this->instruc_operacion,
            'periocidad_calibracion' => $this->periocidad_calibracion,
            'periocidad_verificacion' => $this->periocidad_verificacion,
            'proveedor' => $this->proveedor,
            'contacto_proveedor' => $this->contacto_proveedor,
            'telefono_proveedor' => $this->telefono_proveedor,
            'email_proveedor' => $this->email_proveedor,
            'resolucion' => $this->resolucion,
            'clase_exactitud' => $this->clase_exactitud,
            'rango_medicion' => $this->rango_medicion,
            'intervalo_medicion' => $this->intervalo_medicion,
            'error_maximo_permitido' => $this->error_maximo_permitido,
            'fecha_adquisicion' => $this->fecha_adquisicion->format('Y-m-d'),
            'valor_adquicion' => $this->valor_adquicion,
            'numero_factura' => $this->numero_factura,
            'category_id' => $this->category_id,
            'frecuencia_verificacion' => $this->frecuencia_verificacion,
            'procedimiento_verificacion' => $this->procedimiento_verificacion,
            'frecuencia_calibracion' => $this->frecuencia_calibracion,
            'fecha_calibracion_actual' => $this->fecha_calibracion_actual ? $this->fecha_calibracion_actual->format('Y-m-d') : null,
        'fecha_proxima_calibracion' => $this->fecha_proxima_calibracion ? $this->fecha_proxima_calibracion->format('Y-m-d') : null,
            'maxima_incertidumbre_calibracion' => $this->maxima_incertidumbre_calibracion,
            'proveedor_calibracion' => $this->proveedor_calibracion,
            'contacto_calibracion' => $this->contacto_calibracion,
            'email_calibracion' => $this->email_calibracion,
            'telefono_calibracion' => $this->telefono_calibracion
        ];
    }
}
