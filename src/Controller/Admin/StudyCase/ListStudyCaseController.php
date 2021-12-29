<?php

namespace App\Controller\Admin\StudyCase;

use App\Repository\StudyCaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListStudyCaseController extends AbstractController
{
    /**
     * @Route("admin/studycase/list", name="admin_study_case_list")
     * @param StudyCaseRepository $studyCaseRepository
     * @return Response
     */
    public function list(StudyCaseRepository $studyCaseRepository): Response
    {
        $studyCases = $studyCaseRepository->findAll();

        return $this->render("admin/study_case/list.html.twig",[
            'studyCases' => $studyCases
        ]);
    }
}