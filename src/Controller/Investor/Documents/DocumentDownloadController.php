<?php

namespace App\Controller\Investor\Documents;

use App\Entity\User;
use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;

class DocumentDownloadController extends AbstractController
{
    /**
     * @Route("/investor/document/download/{id}", name="investor_document_download")
     */
    public function downloadFile(int $id,DocumentRepository $documentRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $document = $documentRepository->find($id);

        if(!$document)
        {
            $this->addFlash("danger","This document cannot be found.");
            return $this->redirectToRoute("investor_home");
        }

        if($document->getList()->getInvestor() !== $investor)
        {
            $this->addFlash("danger","This document does not belong to you.");
            return $this->redirectToRoute("investor_home");
        }

        $fileToDownload = $document->getPathToFile();

        $filePathInServer = $this->getParameter('app_files_directory') . '/../..' . $fileToDownload;


        if (!file_exists($filePathInServer)) {
            $this->addFlash("dark","File not found.");
            return $this->redirectToRoute("investor_home");
        }

        $response =  new BinaryFileResponse($filePathInServer);

        $customFileName = $document->getFileName() . '.' . $document->getExtensionName();

        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $customFileName));

        return $response;
    }
}