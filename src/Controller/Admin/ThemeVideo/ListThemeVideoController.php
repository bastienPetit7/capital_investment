<?php

namespace App\Controller\Admin\ThemeVideo;

use App\Repository\ThemeVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListThemeVideoController extends AbstractController
{
    /**
     * @Route("admin/themevideo/list", name="admin_theme_video_list")
     * @param ThemeVideoRepository $themeVideoRepository
     * @return Response
     */
    public function list(ThemeVideoRepository $themeVideoRepository): Response
    {
        $themes = $themeVideoRepository->findAll();

        return $this->render("admin/theme_video/list.html.twig",[
            'themes' => $themes
        ]);
    }
}