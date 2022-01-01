<?php

namespace App\Services\InvestorService;

use App\Entity\Investor;
use App\Repository\DocumentRepository;

class HandleDocument
{
    private DocumentRepository $documentRepository;

    /**
     * @param DocumentRepository $documentRepository
     */
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function getDocumentsByType(Investor $investor,string $type): array
    {
        $listDocument = $investor->getListDocument();

        return $this->documentRepository->findBy([
            'list' => $listDocument,
            'type' => $type
        ]);
    }
}