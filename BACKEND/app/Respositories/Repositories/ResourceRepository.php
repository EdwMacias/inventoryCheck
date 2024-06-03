<?php

namespace App\Respositories\Repositories;

use App\Respositories\Interfaces\InterfaceResourceRepository;
use App\Models\Storage\Resource;
use App\Models\Storage\ResourceModel;

class ResourceRepository implements InterfaceResourceRepository
{
    /**
     *
     * @param array $resource
     * @return bool
     */
    public function create(array $resource): bool
    {
        $resourceModel = new ResourceModel($resource);
        return $resourceModel->save();
    }
}
