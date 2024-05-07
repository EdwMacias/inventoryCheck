<?php

namespace App\Services\Interfaces;
use App\Utils\ResponseHandler;

interface InterfaceTemporaryCodeServices
{
    public function createCodeTemporary($email) : ResponseHandler;

    
    function validateCodeTemporary($code,$email); 
}
