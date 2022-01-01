<?php

namespace App\Controller\Investor\StudyCase;

use App\Repository\StudyCaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudyCaseListController extends AbstractController
{
    /**
     * @Route("/investor/studycase/list/all", name="investor_study_case_all_list")
     * @param StudyCaseRepository $studyCaseRepository
     * @return Response
     */
    public function list(StudyCaseRepository $studyCaseRepository): Response
    {
        $studyCases = $studyCaseRepository->findAll();

        $type = "All";

        return $this->render("investor/study_case/list.html.twig",[
            'type' => $type,
            'studyCases' => $studyCases
        ]);
    }

}