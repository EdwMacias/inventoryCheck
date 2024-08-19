<?php

namespace App\Models\Inventory;

use App\Utils\Sanizacion;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, HasUuids;
    protected $table = "items";
    protected $primaryKey = "item_id";

    protected $fillable = [
        "item_id",
        "category_id",
        "statu_id"
    ];

    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at'
    ];
    public function equipo()
    {
        return $this->hasMany(Equipo::class, 'item_id');
    }
}
