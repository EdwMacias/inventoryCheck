<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryCode extends Model
{
    use HasFactory;
    protected $table = 'temporary_codes';
    protected $primaryKey = 'temporary_code_id';
    protected $fillable = [
        'code',
        'user_id',
        'is_used',
        'expires_at'
    ];

}
