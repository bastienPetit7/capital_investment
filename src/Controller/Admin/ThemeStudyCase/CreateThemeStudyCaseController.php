<?php

namespace App\Controller\Admin\ThemeStudyCase;

use App\Entity\ThemeStudyCase;
use App\Form\ThemeStudyCaseType;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateThemeStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/themestudycase/create", name="admin_theme_study_case_create")
     */
    public function create(ImageService $imageService,EntityManagerInterface $em,Request $request)
    {
        $theme = new ThemeStudyCase();

        $form = $this->createForm(ThemeStudyCaseType::class,$theme);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $imageService->saveImage($file,$theme);
            }
            else
            {
                $this->addFlash("danger","Vous devez ajouter une image.");
                return $this->redirectToRoute("admin_theme_study_case_create");
            }

            $em->persist($theme);

            $em->flush();

            $this->addFlash("light","The theme " . $theme->getName() . " has been created successfully.");

            return $this->redirectToRoute("admin_theme_study_case_list");
        }

        return $this->render("admin/theme_study_case/create.html.twig",[
            'form' => $form->createView()
        ]);
    }
}