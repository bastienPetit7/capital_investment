<?php

namespace App\Controller\Premium;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PremiumHomeController extends AbstractController
{
    /**
     * @Route("/premium/home", name="premium_home")
     */
    public function index(): Response
    {
        return $this->render('premium/premium_home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}