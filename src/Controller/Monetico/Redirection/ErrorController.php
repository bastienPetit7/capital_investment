<?php

namespace App\Controller\Monetico\Redirection;

use App\Entity\Order;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ErrorController extends AbstractController
{


    /**
     * @Route("/cgi/error/{reference}", name="cgi_error")
     *
     * @return void
     */
    public function paiementOk(Order $order)
    {

       dd($order); 


    }




}