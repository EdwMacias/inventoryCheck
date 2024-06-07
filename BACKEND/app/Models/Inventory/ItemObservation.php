<?php

namespace App\Models\Inventory;

use App\Utils\Sanizacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ItemObservation extends Model
{
    use HasFactory, HasUuids;
    protected $table = "item_observations";
    protected $primaryKey = "item_observation_id";

    protected $fillable = [
        'observation',
        'item_id',
        'user_id',
        'types_observation_id',
        'item_observation_id'
    ];

    public function setObservationAttribute($value)
    {
        $this->attributes['observation'] = Sanizacion::cleanInput($value);
    }

    public function hasBeenFiveMinutesSinceCreation(): bool
    {
        $creationTime = $this->created_at;
        $currentTime = Carbon::now();
        return $creationTime->diffInMinutes($currentTime) >= 5;
    }


}
