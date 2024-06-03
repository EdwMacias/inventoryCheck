<?php

namespace App\Models\Users;

use App\Models\User;
use App\Utils\Encriptacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;

    protected $table = 'types_documents';

    protected $primaryKey = 'document_type_id';

    // public $incrementing = false;
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'document_type_id',
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;
    public function toArray()
    {
        $array = parent::toArray();
        // $array['document_type_id'] = Encriptacion::getEncriptacion($this->document_type_id);
        return $array;
    }
    public function users()
    {
        return $this->hasMany(User::class, 'document_type_id');
    }
}
