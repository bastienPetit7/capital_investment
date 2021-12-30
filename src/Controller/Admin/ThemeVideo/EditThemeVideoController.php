<?php

namespace App\Controller\Admin\ThemeVideo;

use App\Entity\ThemeVideo;
use App\Form\ThemeVideoType;
use App\Repository\ThemeVideoRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditThemeVideoController extends AbstractController
{
    /**
     * @Route("admin/themevideo/edit/{id}", name="admin_theme_video_edit")
     */
    public function create(int $id, ThemeVideoRepository $themeVideoRepository,ImageService $imageService,EntityManagerInterface $em,Request $request)
    {
        $theme = $themeVideoRepository->find($id);

        $form = $this->createForm(ThemeVideoType::class,$theme);

        $form->handleRequest($request);

        $originalImage = $theme->getImagePath();

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $imageService->editImage($originalImage,$file,$theme);
            }

            $em->flush();

            $this->addFlash("light","The theme " . $theme->getName() . " has been edited successfully.");

            return $this->redirectToRoute("admin_theme_video_list");
        }

        return $this->render("admin/theme_video/edit.html.twig",[
            'form' => $form->createView()
        ]);
    }
}