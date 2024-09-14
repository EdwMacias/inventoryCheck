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
        $now = now(); // Obtén la fecha y hora actual
        $resources = array_map(function ($registro) use ($now) {
            if (is_array($registro)) {
                $registro['created_at'] = $now;
                $registro['updated_at'] = $now;
            }
            return $registro;
        }, $resources);
        return ResourceModel::insert($resources);
    }
}
