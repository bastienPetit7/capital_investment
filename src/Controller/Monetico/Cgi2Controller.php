<?php

namespace App\Controller\Monetico;

use App\Classe\Monetico\HmacComputer;
use App\Classe\Monetico\MoneticoConfig;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Monetico\Response\ResponseInterface;
use App\Classe\Monetico\Response\BasicPaymentResponseExample;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class Cgi2Controller extends AbstractController
{


    /**
     * @Route("/cgi/response", name="cgi2_response")
     *
     *
     */
    public function cgi2Response(Request $request, OrderRepository $orderRepository, EntityManagerInterface $em)
    {
        
        $isSealValidated = false;

        $receivedData = $_SERVER['REQUEST_METHOD'] === 'GET' ? $_GET : $_POST;

        if (array_key_exists("MAC", $receivedData)) {

            $receivedSeal = $receivedData['MAC'];

            unset($receivedData['MAC']); 

            $isSealValidated = (new HmacComputer())->validateSeal($receivedData, MoneticoConfig::CLE_MAC, $receivedSeal);
        
            if($isSealValidated){
                
                
                
                $codeRetour = $receivedData["code-retour"];
                $isSandboxPayment = $codeRetour === "payetest";
                $isPaymentValidated = substr($codeRetour, 0, strlen("paiement")) === "paiement";
                $reference = $receivedData["reference"]; 
                
                 
                
                if ($isSandboxPayment) {
                    
                    $order = $orderRepository->findOneByReference($reference); 
                    $order->setIsPaid(true); 
                    
                    $em->flush($order); 
                    
                    
                }
            }
            
            
            
        } 
        else {
        throw new \InvalidArgumentException("Unable to verify the sealing since received data did not contain MAC field.");
        }


        $response = new Response(); 
     
        $response->setContent($this->respondWithSealValidationResult($isSealValidated)); 
        $response->headers->set('Content-Type', 'text/plain');
        $response->setStatusCode(200); 

        $response->prepare($request); 
       
        $response->send(); 
        
      
        
    }


    private function respondWithSealValidationResult(bool $isSealValidated)
    {
        
        $str = "version=2\ncdr="; 
        $str .= $isSealValidated ? "0" : "1"; 

        return $str; 
    }
}