<?php

namespace App\Controller\Investor;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvestorHomeController extends AbstractController
{
    /**
     * @Route("/investor/home", name="investor_home")
     */
    public function index(): Response
    {
        return $this->render('investor/investor_home.html.twig');
    }
}
