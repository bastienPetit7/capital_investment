<?php

namespace App\Controller\LandingEbook;

use App\Entity\StudyCase;
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


    /**
     * @Route("/landing/ebook/show/{id}", name="landing_ebook_show")
     *
     * @return void
     */
    public function show(StudyCase $studyCase)
    {

        
        

        return $this->render('landing_ebook/show.html.twig', [
            "book" => $studyCase
        ]); 

    }

    /**
     * @Route("/landing/ebook/getebook/{id}", name="landing_ebook_get")
     *
     * @return void
     */
    public function getStudyCase(StudyCase $studyCase)
    {

        
        

        return $this->render('landing_ebook/funnel_ebook.html.twig', [
            "book" => $studyCase
        ]); 

    }


}