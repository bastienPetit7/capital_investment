<?php

namespace App\Controller\Admin\StudyCase;

use App\Entity\StudyCase;
use App\Form\StudyCaseType;
use App\Services\FileService\HandleSavingFileService;
use App\Services\FileService\HandleSavingNameAndExtensionOfFileService;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/studycase/create", name="admin_study_case_create")
     */
    public function create(EntityManagerInterface $em,Request $request,HandleSavingFileService $handleSavingFileService,
                           HandleSavingNameAndExtensionOfFileService $handleSavingNameAndExtensionOfFileService,
                           ImageService $imageService)
    {
        $studyCase = new StudyCase();

        $form = $this->createForm(StudyCaseType::class,$studyCase);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $imageService->saveImage($imageFile,$studyCase);
            }
            else
            {
                $this->addFlash("danger","You must upload Image.");
                return $this->redirectToRoute("admin_study_case_create");
            }

            /** @var UploadedFile[] $files */
            $pdfFile = $form->get('file')->getData();

            if ($pdfFile) {
                //set Name Of FIle
                $nameOfFile = $handleSavingNameAndExtensionOfFileService->getFileName($pdfFile);
                $studyCase->setFileName($nameOfFile);
                //set Extension Of FIle
                $extensionOfFile = $handleSavingNameAndExtensionOfFileService->getExtension($pdfFile);
                $studyCase->setExtensionName($extensionOfFile);
                $handleSavingFileService->save($pdfFile,$studyCase);
            }
            else
            {
                $this->addFlash("danger","You must upload PDF.");
                return $this->redirectToRoute("admin_study_case_create");
            }

            $em->persist($studyCase);

            $em->flush();

            return $this->redirectToRoute("admin_study_case_list");
        }

        return $this->render("admin/study_case/create.html.twig",[
            'form' => $form->createView()
        ]);
    }
}