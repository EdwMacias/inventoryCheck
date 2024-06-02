<?php

namespace App\Respositories\Repositories;
use App\Respositories\Interfaces\InterfaceResourceRepository;

class ResourceRepository implements InterfaceResourceRepository
{
    /**
     *
     * @param array $resource
     */
    public function create(array $resource) {
        // $resourceItem = new Resource() ;
        // new User();
        
        throw new Exception("Error Processing Request", 1);
    }
}
