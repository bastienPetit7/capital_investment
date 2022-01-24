<?php

namespace App\Controller\LandingSubscription;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingSubscriptionController extends AbstractController
{
    /**
     * @Route("/landing/subscriptions", name="landing_subscription")
     */
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {

        $subs = $subscriptionRepository->findAll(); 

        foreach( $subs as $sub){

            $keyPointsArr = []; 
 
            foreach($sub->getKeyPointId()->getValues() as $points){
 
             
            $keyPointsArr[] = $points->getKeyPoint();
             
            }
 
            $sub->{'keyPoints'} = $keyPointsArr; 
            
         }
 


        return $this->render('landing_subscription/index.html.twig', [
            "subs" => $subs
        ]);
    }
}
