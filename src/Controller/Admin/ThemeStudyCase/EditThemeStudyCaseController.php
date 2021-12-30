<?php

namespace App\Controller\Admin\ThemeStudyCase;

use App\Form\ThemeStudyCaseType;
use App\Repository\ThemeStudyCaseRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditThemeStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/themestudycase/edit/{id}", name="admin_theme_study_case_edit")
     */
    public function create(int $id,ThemeStudyCaseRepository $themeStudyCaseRepository,ImageService $imageService,EntityManagerInterface $em,Request $request)
    {
        $theme = $themeStudyCaseRepository->find($id);

        if(!$theme)
        {
            $this->addFlash("danger","The theme cannot be found.");
            return $this->redirectToRoute("admin_theme_study_case_list");
        }

        $originalImage = $theme->getImagePath();

        $form = $this->createForm(ThemeStudyCaseType::class,$theme);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $imageService->editImage($originalImage,$file,$theme);
            }

            $em->flush();

            $this->addFlash("light","The theme " . $theme->getName() . " has been edited successfully.");

            return $this->redirectToRoute("admin_theme_study_case_list");
        }

        return $this->render("admin/theme_study_case/edit.html.twig",[
            'form' => $form->createView()
        ]);
    }
}