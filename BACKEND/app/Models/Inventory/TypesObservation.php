<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesObservation extends Model
{
    use HasFactory;

    protected $table = 'types_observation';

    protected $primaryKey = 'types_observation_id';
    protected $fillable = [
        'name'
    ];
    protected $hidden = [
        'types_observation',
        'created_at',
        'updated_at'
    ];
}
