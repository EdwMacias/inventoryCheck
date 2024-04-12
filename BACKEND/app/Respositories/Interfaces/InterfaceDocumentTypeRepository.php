<?php

namespace App\Respositories\Interfaces;

interface InterfaceDocumentTypeRepository
{
    /**
     *
     * @param int $documentId
     * @return bool
    */
    public function typeDocumentExist(int $documentId): bool;  

}
