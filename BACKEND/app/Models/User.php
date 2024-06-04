<?php

namespace App\Models;

use App\Models\Status\Status;
use App\Utils\Sanizacion;
use App\Utils\Utilidades;
use HTMLPurifier;
use HTMLPurifier_Config;
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
        'email',
        'number_telephone',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'statu_id',
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Sanizacion::cleanInput($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Sanizacion::cleanInput($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Sanizacion::cleanInput($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Sanizacion::cleanInput($value);
    }

    public function setNumberTelephoneAttribute($value)
    {
        $this->attributes['number_telephone'] = Sanizacion::cleanInput($value);
    }

    public function setNumberDocumentAttribute($value)
    {
        $this->attributes['number_document'] = preg_replace('/[^0-9]/', '', $value);
    }

}
