<?php

namespace App\Repositories\Repositories;

use App\Models\Users\Gender;
use App\Repositories\Interfaces\InterfaceGenderRepository;

class GenderRepository extends Gender implements InterfaceGenderRepository
{


    /**
     *
     * @param int $genderId
     * @return bool
     */
    public function genderExist(int $genderId)
    {
        return parent::where('gender_id', $genderId)->exists();
    }
}
