<?php

namespace App\Models\Terceros\PersonaJuridica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaJuridica extends Model
{
    use HasFactory;
    protected $table = 'persona_juridica';
    protected $primaryKey = 'id';
    protected $fillable = [
        'razon_social',
        'nit',
        'tipo_entidad',
        'registro_camara_comercio',
        'numero_registro_camara_comercio',
        'pais',
        'representante_legal',
        'telefono',
        'email',
    ];
}
