<?php

namespace App\Controller\Investor\Market;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketShowController extends AbstractController
{
    /**
     * @Route("/investor/market", name="investor_market")
     */
    public function index(): Response
    {
        return $this->render("dashboard/investor/market/show.html.twig");
    }
}