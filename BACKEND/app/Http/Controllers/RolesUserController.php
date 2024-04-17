<?php

namespace App\Http\Controllers;

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

    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesRequest $request)
    {
        $roles = $request->all();
        
        
        //
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
