<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $json= ""; 

        $decode64 = base64_decode('ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJBUmVzIiA6ICJZIiwKICAgICAgImxpYWJpbGl0eVNoaWZ0IiA6ICJZIiwKICAgICAgIm1lcmNoYW50UHJlZmVyZW5jZSIgOiAibm9fcHJlZmVyZW5jZSIsCiAgICAgICJ0cmFuc2FjdGlvbklEIiA6ICI2MTJjODg4ZC0wMWZjLTRlNWMtOTNkNS04NDM0ZGExMzkyZTAiCiAgIH0sCiAgICJwcm9').'" : "ok"}'; 

         
        
       
        //   dd( $decode64);   
        //   dd( json_decode($decode64)->details->transactionID);

        return $this->redirectToRoute("app_login");


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
