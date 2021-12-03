<?php

namespace App\Controller\Freemium;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FreemiumHomeController extends AbstractController
{
    /**
     * @Route("/freemium/home", name="freemium_home")
     */
    public function index(): Response
    {
        return $this->render('freemium/freemium_home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}