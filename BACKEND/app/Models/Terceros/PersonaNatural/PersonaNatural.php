<?php

namespace App\Models\Terceros\PersonaNatural;

use App\Models\Users\TypeDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'persona_natural';
    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'document_type_id',
        'numero_identificacion',
        'dv',
        'telefono',
        'correo',
        'direccion',
        'departamento',
        'ciudad',
    ];

    public function documento(){
        return $this->belongsTo(TypeDocument::class, 'document_type_id','document_type_id');
    }
}
