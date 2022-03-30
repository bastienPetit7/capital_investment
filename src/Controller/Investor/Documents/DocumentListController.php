<?php

namespace App\Controller\Investor\Documents;

use App\Dictionary\DocumentTypeInvestor;
use App\Entity\User;
use App\Services\InvestorService\HandleDocument;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentListController extends AbstractController
{
    /**
     * @Route("/investor/document/list/reporting", name="investor_document_reporting_list")
     */
    public function reportingList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::REPORTING;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("dashboard/investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/investor/document/list/contract", name="investor_document_contract_list")
     */
    public function contractsList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::CONTRACTS;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("dashboard/investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/investor/document/list/personaldocuments", name="investor_document_personal_document_list")
     */
    public function actOfPurchaseList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::PERSONAL_DOCUMENTS;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("dashboard/investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/investor/document/list/operationstatement", name="investor_document_operation_statement_list")
     */
    public function operationStatementList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::OPERATION_STATEMENT;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("dashboard/investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/investor/document/list/legalnotice", name="investor_document_legal_notice_list")
     */
    public function legalNoticeList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::MENTIONS_LEGALS;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("dashboard/investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }
}