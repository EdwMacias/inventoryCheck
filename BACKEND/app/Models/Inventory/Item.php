<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = "items";
    protected $primaryKey = "item_id";

    protected $fillable = [
        "name",
        "serial_number",
        "description",
        "category_id",
        "statu_id"
    ];
    
    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at'
    ];
}
