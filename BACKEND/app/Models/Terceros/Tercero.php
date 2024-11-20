<?php

namespace App\Models\Terceros;

use App\Models\Users\TypeDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tercero extends Model
{
    use HasFactory;
    protected $table = 'terceros';
    protected $primaryKey = 'terceroId';
    protected $fillable = [
        'tipoDocumentoId',
        '#documento',
        'tipoPersonaId',
        'razonSocial',
        'primerNombre',
        'segundoNombre',
        'primerApellido',
        'segundoApellido',
        'email',
        'direccion',
        'ciudad',
        'departamento',
        'pais',
        'telefono',
        'foto'
    ];


    public function infoTipoDocumento()
    {
        return $this->hasMany(TypeDocument::class, 'document_type_id', 'tipoDocumentoId');
    }

    public function infoTipoPersona()
    {
        return $this->hasMany(TipoPersona::class, 'tipoPersonaId', 'tipoPersonaId');
    }
}
