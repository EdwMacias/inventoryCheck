<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;
    protected $table = 'unidades';
    protected $primaryKey = 'unidad_id';
    protected $fillable = [
        "nombre",
        'codigo',
        "created_at",
        "updated_at"
    ];
}
