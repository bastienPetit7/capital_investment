<?php

namespace App\Controller\LandingEbook;

use App\Repository\StudyCaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LandingEbookController extends AbstractController
{


    /**
     * @Route("/landing/ebook", name="landing_ebook")
     *
     * @return void
     */
    public function index(StudyCaseRepository $studyCaseRepository)
    {

        $ebooks = $studyCaseRepository->findAll(); 
        

        return $this->render('landing_ebook/index.html.twig', [
            "ebooks" => $ebooks
        ]); 

    }


}