<?php

namespace App\Controller\Admin\StudyCase;

use App\Repository\StudyCaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShowStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/studycase/show/{id}", name="admin_study_case_show")
     */
    public function show(int $id,StudyCaseRepository $studyCaseRepository)
    {
        $studyCase = $studyCaseRepository->find($id);

        if(!$studyCase)
        {
            $this->addFlash("danger","This study case is not found.");
            return $this->redirectToRoute("admin_study_case_list");
        }

        return $this->render("admin/study_case/show.html.twig",[
            'studyCase' => $studyCase
        ]);
    }

    /**
     * @Route("admin/studycase/downloadpdf/{id}", name="admin_study_case_download_pdf")
     */
    public function downloadFile(int $id,StudyCaseRepository $studyCaseRepository)
    {
        $studyCase = $studyCaseRepository->find($id);

        if(!$studyCase)
        {
            $this->addFlash("danger","This study case is not found.");
            return $this->redirectToRoute("admin_study_case_list");
        }

        $fileToDownload = $studyCase->getPathToFile();

        $filePathInServer = $this->getParameter('app_files_directory') . '/../..' . $fileToDownload;


        if (!file_exists($filePathInServer)) {
            $this->addFlash("dark","File not found.");
            return $this->redirectToRoute("admin_study_case_show",['id' => $id ]);
        }

        $response =  new BinaryFileResponse($filePathInServer);

        $customFileName = $studyCase->getFileName() . '.' . $studyCase->getExtensionName();

        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $customFileName));

        return $response;
    }
}