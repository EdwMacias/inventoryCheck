<?php

namespace App\Respositories\Interfaces;

interface InterfaceGenderRepository
{
    /** 
     *@param int $genderId
     *@return bool
     */
    public function genderExist(int $genderId);

}
