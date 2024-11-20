<?php

namespace App\Models\Terceros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;
    protected $table = 'tipo_personas';
    protected $primaryKey = 'tipoPersonaId';
    protected $fillable = [
        'nombre',
        'codigo',
    ];
}
