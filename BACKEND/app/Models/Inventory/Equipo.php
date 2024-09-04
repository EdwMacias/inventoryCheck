<?php

namespace App\Models\Inventory;

use App\Models\Storage\ResourceModel;
use App\Utils\Sanizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    protected $primaryKey = 'equipo_id';
    protected $fillable = [
        'item_id',
        'name',
        'fabricante',
        'modelo',
        'marca',
        'serie_lote',
        'activo_fijo',
        'ubicacion',
        'ficha_tecnica',
        'manual',
        'garantia',
        'instruc_operacion',
        'periodicidad_calibracion',
        'periodicidad_verificacion',
        'proveedor',
        'contacto_proveedor',
        'telefono_proveedor',
        'email_proveedor',
        'resolucion',
        'clase_exactitud',
        'rango_medicion',
        'intervalo_medicion',
        'error_maximo_permitido',
        'fecha_adquisicion',
        'valor_adquision',
        'numero_factura',
        'fecha_calibracion_actual',
        'fecha_proxima_calibracion',
        'maxima_incertidumbre_calibracion',
        'proveedor_calibracion',
        'contacto_calibracion',
        'telefono_calibracion',
        'email_calibracion',
        'frecuencia_verificacion',
        'procedimiento_verificacion',
        'cond_electrica',
        'cond_mecanica',
        'cond_seguridad',
        'cond_ambientales',
        'cond_transporte',
        'cond_otras'
    ];

    public function resource()
    {
        return $this->hasMany(
            ResourceModel::class,
            'item_id',
            'item_id'
        );
    }

    public function resources()
    {
        return $this->hasMany(ResourceModel::class, 'item_id', "item_id");
    }

    public function observaciones()
    {
        return $this->belongsTo(ItemObservation::class, 'item_id', 'item_id')->with("resources");
    }
    public function setItemIdAttribute($value)
    {
        $this->attributes['item_id'] = Sanizacion::cleanInput($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Sanizacion::cleanInput($value);
    }

    public function setFabricanteAttribute($value)
    {
        $this->attributes['fabricante'] = Sanizacion::cleanInput($value);
    }

    public function setModeloAttribute($value)
    {
        $this->attributes['modelo'] = Sanizacion::cleanInput($value);
    }

    public function setMarcaAttribute($value)
    {
        $this->attributes['marca'] = Sanizacion::cleanInput($value);
    }

    public function setSerieLoteAttribute($value)
    {
        $this->attributes['serie_lote'] = Sanizacion::cleanInput($value);
    }

    public function setActivoFijoAttribute($value)
    {
        $this->attributes['activo_fijo'] = Sanizacion::cleanInput($value);
    }

    public function setUbicacionAttribute($value)
    {
        $this->attributes['ubicacion'] = Sanizacion::cleanInput($value);
    }

    public function setFichaTecnicaAttribute($value)
    {
        $this->attributes['ficha_tecnica'] = Sanizacion::cleanInput($value);
    }

    public function setManualAttribute($value)
    {
        $this->attributes['manual'] = Sanizacion::cleanInput($value);
    }

    public function setGarantiaAttribute($value)
    {
        $this->attributes['garantia'] = Sanizacion::cleanInput($value);
    }

    public function setInstrucOperacionAttribute($value)
    {
        $this->attributes['instruc_operacion'] = Sanizacion::cleanInput($value);
    }

    public function setperiodicidadCalibracionAttribute($value)
    {
        $this->attributes['periodicidad_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setperiodicidadVerificacionAttribute($value)
    {
        $this->attributes['periodicidad_verificacion'] = Sanizacion::cleanInput($value);
    }

    public function setProveedorAttribute($value)
    {
        $this->attributes['proveedor'] = Sanizacion::cleanInput($value);
    }

    public function setContactoProveedorAttribute($value)
    {
        $this->attributes['contacto_proveedor'] = Sanizacion::cleanInput($value);
    }

    public function setTelefonoProveedorAttribute($value)
    {
        $this->attributes['telefono_proveedor'] = Sanizacion::cleanInput($value);
    }

    public function setEmailProveedorAttribute($value)
    {
        $this->attributes['email_proveedor'] = Sanizacion::cleanInput($value);
    }

    public function setResolucionAttribute($value)
    {
        $this->attributes['resolucion'] = Sanizacion::cleanInput($value);
    }

    public function setClaseExactitudAttribute($value)
    {
        $this->attributes['clase_exactitud'] = Sanizacion::cleanInput($value);
    }

    public function setRangoMedicionAttribute($value)
    {
        $this->attributes['rango_medicion'] = Sanizacion::cleanInput($value);
    }

    public function setIntervaloMedicionAttribute($value)
    {
        $this->attributes['intervalo_medicion'] = Sanizacion::cleanInput($value);
    }

    public function setErrorMaximoPermitidoAttribute($value)
    {
        $this->attributes['error_maximo_permitido'] = Sanizacion::cleanInput($value);
    }

    public function setFechaAdquisicionAttribute($value)
    {
        $this->attributes['fecha_adquisicion'] = new \DateTime(Sanizacion::cleanInput($value));
    }

    public function setValoradquisionAttribute($value)
    {
        $this->attributes['valor_adquision'] = Sanizacion::cleanInput($value);
    }

    public function setNumeroFacturaAttribute($value)
    {
        $this->attributes['numero_factura'] = Sanizacion::cleanInput($value);
    }

    // public function setFechaCalibracionActualAttribute($value)
    // {
    //     $this->attributes['fecha_calibracion_actual'] = new \DateTime(Sanizacion::cleanInput($value));
    // }

    // public function setFechaProximaCalibracionAttribute($value)
    // {
    //     $this->attributes['fecha_proxima_calibracion'] = new \DateTime(Sanizacion::cleanInput($value));
    // }

    public function setMaximaIncertidumbreCalibracionAttribute($value)
    {
        $this->attributes['maxima_incertidumbre_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setProveedorCalibracionAttribute($value)
    {
        $this->attributes['proveedor_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setContactoCalibracionAttribute($value)
    {
        $this->attributes['contacto_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setTelefonoCalibracionAttribute($value)
    {
        $this->attributes['telefono_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setEmailCalibracionAttribute($value)
    {
        $this->attributes['email_calibracion'] = Sanizacion::cleanInput($value);
    }

    public function setFrecuenciaVerificacionAttribute($value)
    {
        $this->attributes['frecuencia_verificacion'] = Sanizacion::cleanInput($value);
    }

    public function setProcedimientoVerificacionAttribute($value)
    {
        $this->attributes['procedimiento_verificacion'] = Sanizacion::cleanInput($value);
    }

    public function setFrecuenciaCalibracionAttribute($value)
    {
        $this->attributes['frecuencia_calibracion'] = Sanizacion::cleanInput($value);
    }
}
