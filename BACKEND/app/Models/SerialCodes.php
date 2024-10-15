<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialCodes extends Model
{
    use HasFactory;
    protected $primaryKey = 'serial_code_id';
    protected $table = 'serial_codes';

    protected $fillable = [
        "nombre",
        "codigo",
        "created_at",
        "updated_at"
    ];
}
