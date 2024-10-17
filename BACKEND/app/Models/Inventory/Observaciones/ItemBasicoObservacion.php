<?php

namespace App\Models\Inventory\Observaciones;

use App\Models\Inventory\ItemBasico;
use App\Models\Storage\ResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBasicoObservacion extends Model
{
    use HasFactory, HasUuids;
    protected $table = "observaciones_items_basicos";
    protected $primaryKey = "observacion_item_basico_id";
    protected $fillable = [
        "observacion_item_basico_id",
        "item_basico_id",
        "fecha",
        "descripcion",
        "user_id"
    ];
    public function oficina()
    {
        return $this->belongsTo(ItemBasico::class, 'item_basico_id','item_basico_id')->with(["observaciones"]);
    }
}
