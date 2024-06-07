<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemObservationsWithResource extends Model
{
    use HasFactory, HasUuids;

    protected $table = "item_observations_with_resource";
    protected $primaryKey = "item_observation_id";
}
