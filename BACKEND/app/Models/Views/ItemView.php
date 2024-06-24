<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemView extends Model
{
    use HasFactory, HasUuids;

    protected $table = "audiovisual_items";

    protected $primaryKey = "item_id";
}
