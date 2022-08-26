<?php

namespace App\Controller\ApiReactNative;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfidentialyController extends AbstractController
{
    /**
     * @Route("/legal/confidentiality", name="api_legal_confidentiality")
     */
    public function legal()
    {
        return $this->render('dashboard/investor/legal/confidentiality.html.twig');
    }
}