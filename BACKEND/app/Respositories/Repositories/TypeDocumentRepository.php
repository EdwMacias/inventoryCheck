<?php

namespace App\Respositories\Repositories;
use App\Models\Users\TypeDocument;
use App\Respositories\Interfaces\InterfaceDocumentTypeRepository;

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
