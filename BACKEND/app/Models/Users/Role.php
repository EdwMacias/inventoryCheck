<?php

namespace App\Models\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'role_id',
        'created_at',
        'updated_at'
    ];

}
