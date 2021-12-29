<?php

namespace App\Controller\Admin\ThemeStudyCase;

use App\Repository\ThemeStudyCaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListThemeStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/themestudycase/list", name="admin_theme_study_case_list")
     * @param ThemeStudyCaseRepository $themeStudyCaseRepository
     * @return Response
     */
    public function list(ThemeStudyCaseRepository $themeStudyCaseRepository): Response
    {
        $themes = $themeStudyCaseRepository->findAll();

        return $this->render("admin/theme_study_case/list.html.twig",[
            'themes' => $themes
        ]);
    }
}