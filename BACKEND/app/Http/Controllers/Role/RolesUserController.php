<?php

namespace App\Http\Controllers\Role;

use App\DTOs\RolesDTOs\RoleRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Users\UserRole;
use Illuminate\Http\Request;

class RolesUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assing(RolesRequest $rolesRequest)
    {
        $rolesRequestDTO = RoleRequestDTO::fromArray($rolesRequest->all());
        
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRole $userRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $userRole)
    {
        //
    }
}
