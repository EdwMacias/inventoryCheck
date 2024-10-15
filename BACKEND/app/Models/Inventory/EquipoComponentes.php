<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoComponentes extends Model
{
    use HasFactory;
    protected $table = "equipo_componente";
    protected $primaryKey = "equipo_compt_id";
    protected $fillable = [
        "item_id",
        "serial",
        "cantidad",
        "cuidados",
        "modelo",
        "marca",
        "nombre",
        "unidad"
    ];
}
