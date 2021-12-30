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

class EditStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/studycase/edit/{id}", name="admin_study_case_edit")
     */
    public function edit(int $id,StudyCaseRepository $studyCaseRepository,EntityManagerInterface $em,Request $request,
                           HandleSavingFileService $handleSavingFileService,
                           HandleSavingNameAndExtensionOfFileService $handleSavingNameAndExtensionOfFileService,
                           ImageService $imageService)
    {
        $studyCase = $studyCaseRepository->find($id);

        if(!$studyCase)
        {
            $this->addFlash("danger","This study case cannot be found");
            return $this->redirectToRoute("admin_study_case_list");
        }

        $originalImage = $studyCase->getImagePath();

        $originalPdf = $studyCase->getPathToFile();

        $form = $this->createForm(StudyCaseType::class,$studyCase);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            /** @var UploadedFile $file */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $imageService->editImage($originalImage,$imageFile,$studyCase);
            }

            /** @var UploadedFile $pdfFile */
            $pdfFile = $form->get('file')->getData();

            if ($pdfFile) {
                //set Name Of FIle
                $nameOfFile = $handleSavingNameAndExtensionOfFileService->getFileName($pdfFile);
                $studyCase->setFileName($nameOfFile);
                //set Extension Of FIle
                $extensionOfFile = $handleSavingNameAndExtensionOfFileService->getExtension($pdfFile);
                $studyCase->setExtensionName($extensionOfFile);
                $handleSavingFileService->edit($originalPdf,$pdfFile,$studyCase);
            }

            $em->flush();

            $this->addFlash("light","This study case has been updated successfully");


            return $this->redirectToRoute("admin_study_case_show",['id' => $id]);
        }

        return $this->render("admin/study_case/edit.html.twig",[
            'form' => $form->createView()
        ]);
    }
}