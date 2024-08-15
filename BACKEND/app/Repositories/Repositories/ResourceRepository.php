<?php

namespace App\Repositories\Repositories;

use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Models\Storage\Resource;
use App\Models\Storage\ResourceModel;

class ResourceRepository implements InterfaceResourceRepository
{
    /**
     *
     * @param ResourceDTO $resource
     * @return bool
     */
    public function create(ResourceDTO $resource): bool
    {
        $resourceModel = new ResourceModel($resource->toArray());
        return $resourceModel->save();
    }
    /**
     * Summary of createRecords
     * @param array $resources
     * @return bool
     */
    public function createRecords(array $resources)
    {
        return ResourceModel::insert($resources);
    }
}
