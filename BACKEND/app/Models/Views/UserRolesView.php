<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRolesView extends Model
{
    use HasFactory;
    protected $table = "user_roles_view";
    protected $primaryKey = "user_role_id";

}
