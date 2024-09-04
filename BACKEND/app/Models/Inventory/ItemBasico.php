<?php

namespace App\Models\Inventory;

use App\Models\Storage\ResourceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBasico extends Model
{
    use HasFactory;
    protected $table = "item_basico";
    protected $primaryKey = "item_basico_id";
    protected $fillable = [
        "name",
        "serie_lote",
        "valor_adquisicion",
        "item_id"
    ];
    public function resource (){
        return $this->hasMany(
            ResourceModel::class,
            'item_id',
            'item_id'
        );
    }
}
