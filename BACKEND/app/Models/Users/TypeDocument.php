<?php

namespace App\Models\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;

    protected $table = 'types_documents';

    protected $primaryKey = 'document_type_id';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'document_type_id',
        'created_at',
        'updated_at'
    ];

}
