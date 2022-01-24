<?php

namespace App\Controller\Monetico;

use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Monetico\Response\ResponseInterface;
use App\Classe\Monetico\Response\BasicPaymentResponseExample;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class Cgi2Controller extends AbstractController
{


    /**
     * @Route("/cgi/response", name="cgi2_response")
     *
     * @return void
     */
    public function cgi2Response()
    {


        

        $response = new ResponseInterface(); 

     


    }
}