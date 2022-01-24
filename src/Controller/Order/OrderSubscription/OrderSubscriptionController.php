<?php

namespace App\Controller\Order\OrderSubscription;

use DateTime;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\PaiementMoneticoService\CheckoutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSubscriptionController extends AbstractController
{


    /**
     * @Route("/order/recap/subscription/{id}", name="order_subscription_recap")
     *
     * @return void
     */
    public function recapOrder(Subscription $subscription, EntityManagerInterface $em)
    {

        if(!$this->getUser()){

            $this->addFlash("dark", "You must register or login to go further"); 
           return $this->redirectToRoute("app_login"); 
        }
        

        $date = new DateTime(); 
        $reference = $date->format('dmY'). '-' . uniqid();

        $order = new Order(); 
        $order->setReference($reference); 
        $order->setCreatedAt($date); 
        $order->setUser($this->getUser()); 
        $order->setIsPaid(0); 

        $em->persist($order); 

        $orderDetails = new OrderDetails(); 
        $orderDetails->setMyOrder($order); 
        $orderDetails->setProduct($subscription->getName());
        $orderDetails->setPrice($subscription->getPrice()); 
        
        $em->persist($orderDetails); 

        $em->flush(); 


        $payment = new CheckoutService($this->getUser(), $subscription, $reference); 


        $formFields = $payment->getPaymentRequest()->getFormFields(); 

         

      

        $keypointsObj = $subscription->getKeyPointId()->getValues(); 
        $keyPoints = []; 

        foreach($keypointsObj as $points){

            $keyPoints[] = $points->getKeyPoint(); 

        }

        

        
        return $this->render('order/subscription/order_recap.html.twig', [
            "sub" => $subscription, 
            "user" => $this->getUser(), 
            "keyPoints" => $keyPoints, 
            "formFields" => $formFields
        ]);

    }


}