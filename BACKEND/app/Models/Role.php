<?php

namespace App\Models;

use App\Utils\Encriptacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    // public $incrementing = false;
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'role_id',
        'created_at',
        'updated_at'
    ];

    // public $timestamps = false;
    // public function toArray()
    
    // {
    //     $array = parent::toArray();
    //     // $array['role_id'] = Encriptacion::getEncriptacion($this->role_id);
    //     return $array;
    // }
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
