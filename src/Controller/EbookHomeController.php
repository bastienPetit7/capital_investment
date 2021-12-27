<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EbookHomeController extends AbstractController
{

    /**
     * @Route("capital-investment/etude-de-cas", name="capital_investment_ebook")
     */
    public function index()
    {

        return $this->render('shared/_ebook_accueil.html.twig'); 

    }
    
}