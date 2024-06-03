<?php

namespace App\Services\Interfaces;

use Illuminate\Http\JsonResponse;

interface InterfaceItemServices
{
    public function create(array $item, $resource): JsonResponse;
    // public function update($id, array $item): JsonResponse;
    public function listItemPagination(): JsonResponse;
}
