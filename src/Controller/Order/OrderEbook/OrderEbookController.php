<?php

namespace App\Controller\Order\OrderEbook;

use DateTime;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\StudyCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\PaiementMoneticoService\CheckoutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderEbookController extends AbstractController
{


    /**
     * @Route("/order/recap/ebook/{id}", name="order_ebook_recap")
     *
     * @return void
     */
    public function recapOrder(StudyCase $studyCase, EntityManagerInterface $em)
    {

        if(!$this->getUser()){

            $this->addFlash("dark", "You must register or login to go further"); 
           return $this->redirectToRoute("app_login"); 
        }
        

        $date = new DateTime(); 
        $reference = $date->format('dmY'). '-' . uniqid() .'book';

        $order = new Order(); 
        $order->setReference($reference); 
        $order->setCreatedAt($date); 
        $order->setUser($this->getUser()); 
        $order->setIsPaid(0); 

        $em->persist($order); 

        $orderDetails = new OrderDetails(); 
        $orderDetails->setMyOrder($order); 
        $orderDetails->setProduct($studyCase->getName());
        $orderDetails->setPrice($studyCase->getPrice()); 
        
        $em->persist($orderDetails); 

        $em->flush(); 


        $payment = new CheckoutService($this->getUser(), $studyCase, $reference); 


        $formFields = $payment->getPaymentRequest()->getFormFields(); 


        
        return $this->render('order/ebook/order_recap.html.twig', [
            "book" => $studyCase, 
            "user" => $this->getUser(),  
            "formFields" => $formFields
        ]);

    }


}