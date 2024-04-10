<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $primaryKey = "gender_id";

    protected $table = "genders";
    protected $hidden = [
        'gender_id',
        'created_at',
        'updated_at'
    ];


}
