<?php

namespace App\DTOs\ItemDTOs\EquiposDTOs;

class EquiposCreateDTO
{
    public string $item_id;
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

    public function __construct(
        string $item_id,
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
        ?string $numero_factura
    ) {
        $this->item_id = $item_id;
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
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['item_id'],
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
            $data['numero_factura'] ?? null
        );
    }
    
}
