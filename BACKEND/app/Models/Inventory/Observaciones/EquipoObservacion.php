<?php

namespace App\Models\Inventory\Observaciones;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoObservacion extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'observacion_equipo_id';
    protected $table = 'observaciones_equipos';
    protected $fillable = [
        'observacion_equipo_id',
        'equipo_id',
        'fecha',
        'asunto',
        'actividad',
        'estado',
        'responsable',
        'firma_responsable',
        'proxima_actividad',
    ];
}
