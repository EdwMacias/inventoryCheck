<?php

namespace App\Repositories\Repositories;
use App\Models\Users\TypeDocument;
use App\Repositories\Interfaces\InterfaceDocumentTypeRepository;

class TypeDocumentRepository extends TypeDocument implements InterfaceDocumentTypeRepository
{
    

    /**
     *
     * @param int $documentId
     * @return bool
     */
    public function typeDocumentExist(int $documentId): bool {
        return parent::where("document_type_id", $documentId)->exists();
    }
}
