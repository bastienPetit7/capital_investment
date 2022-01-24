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
     * @Route("/investor/document/list/actofsale", name="investor_document_act_of_sale_list")
     */
    public function actOfSaleList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::ACT_OF_SALE;

        $documents = $handleDocument->getDocumentsByType($investor,$type);

        return $this->render("investor/documents/list.html.twig",[
            'type' => $type,
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/investor/document/list/actofpurchase", name="investor_document_act_of_purchase_list")
     */
    public function actOfPurchaseList(HandleDocument $handleDocument): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $type = DocumentTypeInvestor::ACT_OF_PURCHASE;

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
}