<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use App\Repository\InvestorRepository;
use App\Services\FileService\HandleSavingFileService;
use App\Services\FileService\HandleSavingNameAndExtensionOfFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleFilesController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlefiles/{id}", name="admin_investor_profile_handle_files")
     */
    public function show(int $id,EntityManagerInterface $em,InvestorRepository $investorRepository, Request $request,HandleSavingFileService $handleSavingFileService,
                         HandleSavingNameAndExtensionOfFileService $handleSavingNameAndExtensionOfFileService)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $document = new Document();

        $form = $this->createForm(DocumentType::class,$document);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $pdfFile */
            $pdfFile = $form->get('file')->getData();

            if ($pdfFile) {
                //set Name Of FIle
                $nameOfFile = $handleSavingNameAndExtensionOfFileService->getFileName($pdfFile);
                $document->setFileName($nameOfFile);
                //set Extension Of FIle
                $extensionOfFile = $handleSavingNameAndExtensionOfFileService->getExtension($pdfFile);
                $document->setExtensionName($extensionOfFile);
                $handleSavingFileService->save($pdfFile,$document);
            }
            else
            {
                $this->addFlash("danger","You must upload PDF.");
                return $this->redirectToRoute("admin_investor_profile_handle_files",['id' => $id]);
            }

            $document->setList($investor->getListDocument());

            $em->persist($document);
            $em->flush();

            $this->addFlash("light","The file has been uploaded successfully.");
            return $this->redirectToRoute("admin_investor_profile_handle_files",['id' => $id]);
        }

        $documents = $investor->getListDocument()->getDocuments();

        return $this->render('admin/investor_profile/handle_files.html.twig',[
            'investor' => $investor,
            'form' => $form->createView(),
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/admin/investorprofile/downloadfile/{id}/{documentId}", name="admin_investor_profile_download_file")
     */
    public function downloadFile(int $id,int $documentId,InvestorRepository $investorRepository,DocumentRepository $documentRepository)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $document = $documentRepository->find($documentId);

        if(!$document)
        {
            $this->addFlash("danger","This document cannot be found");
            return $this->redirectToRoute("admin_investor_profile_handle_files",['id' => $id]);
        }

        $fileToDownload = $document->getPathToFile();

        $filePathInServer = $this->getParameter('app_files_directory') . '/../..' . $fileToDownload;


        if (!file_exists($filePathInServer)) {
            $this->addFlash("dark","File not found.");
            return $this->redirectToRoute("admin_investor_profile_handle_files",['id' => $id ]);
        }

        $response =  new BinaryFileResponse($filePathInServer);

        $customFileName = $document->getFileName() . '.' . $document->getExtensionName();

        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $customFileName));

        return $response;
    }
}