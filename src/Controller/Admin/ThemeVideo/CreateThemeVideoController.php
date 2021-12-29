<?php

namespace App\Controller\Admin\ThemeVideo;

use App\Entity\ThemeVideo;
use App\Form\ThemeVideoType;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateThemeVideoController extends AbstractController
{
    /**
     * @Route("admin/themevideo/create", name="admin_theme_video_create")
     */
    public function create(ImageService $imageService,EntityManagerInterface $em,Request $request)
    {
        $theme = new ThemeVideo();

        $form = $this->createForm(ThemeVideoType::class,$theme);

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
                return $this->redirectToRoute("admin_theme_video_create");
            }

            $em->persist($theme);

            $em->flush();

            $this->addFlash("light","The theme " . $theme->getName() . " has been created successfully.");

            return $this->redirectToRoute("admin_theme_video_list");
        }

        return $this->render("admin/theme_video/create.html.twig",[
            'form' => $form->createView()
        ]);
    }
}