<?php

namespace App\Models\Storage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceModel extends Model
{
    
    use HasFactory;
    protected $table = "audiovisual_resource";

    protected $primaryKey = "audiovisual_resource_id";

    protected $fillable = [
        "item_id",
        "item_observation_id",
        "resource"
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function rules($id = null)
    {
        return [
            'item_id' => 'nullable|exists:items,id',
            'item_observation_id' => 'nullable|exists:item_observations,id',
            'resource' => 'required|string|max:255',
        ];
    }

}
