<?php

namespace App\Models;

use App\Models\Status\Status;
use App\Models\Users\Role;
use App\Models\Users\TypeDocument;
use App\Utils\Encriptacion;
use App\Utils\Utilidades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role_id',
        'document_type_id',
    ];

    protected $hidden = [
        'password',
        'role_id',
        'statu_id',
        'document_type_id',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            "name" => $this->name,
            "last_name" => $this->last_name,
            "email" => $this->email,
        ];
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array["user_id"] = Encriptacion::getEncriptacion($this->id);
        return $array;
    }
    public function save(array $options = [])
    {
        $this->password = Utilidades::EncriptarPassword($this->password);
        return parent::save($options);
    }


    public function update(array $attributes = [], array $options = []): bool
    {
        $this->password = Utilidades::EncriptarPassword($this->password);
        return parent::update($attributes,$options);
    }

    public function getUserWithRelatedData()
    {
        $usuario = $this->with(['role', 'documentType','statu'])->find($this->user_id);
        return $usuario->toArray();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function documentType()
    {
        return $this->belongsTo(TypeDocument::class, 'document_type_id');
    }

    public function statu(){
        return $this->belongsTo(Status::class,'statu_id');
    }
}
