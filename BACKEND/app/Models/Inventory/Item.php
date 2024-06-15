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
        "name",
        "serial_number",
        "description",
        "statu_id"
    ];

    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Sanizacion::cleanInput($value);
    }

    public function setSerialNumberAttribute($value)
    {
        $value = preg_replace('/\s+/', '', $value);
        $this->attributes['serial_number'] = Sanizacion::cleanInput($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Sanizacion::cleanInput($value);
    }

    public function setStatuIdAttribute($value)
    {
        $this->attributes['statu_id'] = Sanizacion::cleanInput($value);
    }
}
