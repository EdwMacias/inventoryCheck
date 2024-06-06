<?php

namespace App\Repositories\Interfaces;

interface InterfaceDocumentTypeRepository
{
    /**
     *
     * @param int $documentId
     * @return bool
    */
    public function typeDocumentExist(int $documentId): bool;  

}
