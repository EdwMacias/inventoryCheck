<?php

namespace App\Models\Inventory;

use App\Utils\Sanizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemObservation extends Model
{
    use HasFactory; 
    protected $table = "item_observations";
    protected $primaryKey = "item_observation_id";
    
    protected $fillable = [
        'observation',
        'item_id',
        'user_id',
        'types_observation_id',
    ];

    public function setObservationAttribute($value)
    {
        $this->attributes['observation'] = Sanizacion::cleanInput($value);
    }


}
