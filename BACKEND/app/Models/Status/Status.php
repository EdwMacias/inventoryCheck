<?php

namespace App\Models\Status;

use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $primaryKey = 'statu_id';
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'statu_id',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany(ModelsUser::class, 'status_id');
    }
}
