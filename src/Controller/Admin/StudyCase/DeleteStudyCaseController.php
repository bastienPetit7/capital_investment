<?php

namespace App\Controller\Admin\StudyCase;

use App\Entity\StudyCase;
use App\Form\StudyCaseType;
use App\Repository\StudyCaseRepository;
use App\Services\FileService\HandleSavingFileService;
use App\Services\FileService\HandleSavingNameAndExtensionOfFileService;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/studycase/delete/{id}", name="admin_study_case_delete")
     */
    public function edit(int $id,StudyCaseRepository $studyCaseRepository,EntityManagerInterface $em)
    {
        $studyCase = $studyCaseRepository->find($id);

        if(!$studyCase)
        {
            $this->addFlash("danger","This study case cannot be found");
            return $this->redirectToRoute("admin_study_case_list");
        }

        $fileToDownload = $studyCase->getPathToFile();

        $filePathInServer = $this->getParameter('app_files_directory') . '/../..' . $fileToDownload;


        if (file_exists($filePathInServer)) {
            unlink($filePathInServer);
        }

        $em->remove($studyCase);

        $em->flush();

        $this->addFlash("success","The e-book has been deleted");
        return $this->redirectToRoute("admin_study_case_list");

    }
}