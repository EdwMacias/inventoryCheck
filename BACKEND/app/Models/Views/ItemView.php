<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemView extends Model
{
    use HasFactory, HasUuids;

    protected $table = "item_views";

    protected $primaryKey = "item_id";

    protected $fillable = [
        "resource",
    ];

}
