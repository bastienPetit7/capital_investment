<?php

namespace App\Controller\ApiReactNative;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MarketViewController extends AbstractController
{
    /**
     * @Route("/marketview/app", name="api_market_view")
     */
    public function marketView()
    {
        return $this->render('dashboard/investor/market/app_view.html.twig');
    }
}