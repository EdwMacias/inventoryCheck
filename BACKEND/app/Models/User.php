<?php

namespace App\Models;

use App\Models\Status\Status;
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
        'statu_id',
        'password',
        'document_type_id',
        'gender_id',
        'address',
        'number_document',
        'name',
        'last_name',
        'address',
        'number_telephone',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'document_type_id',
        'number_document',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'gender_id',
        'statu_id',
        'address',
        'number_telephone'
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
        return parent::update($attributes, $options);
    }

    public function statu()
    {
        return $this->belongsTo(Status::class, 'statu_id');
    }
}
