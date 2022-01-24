<?php

namespace App\Controller\LandingSubscription;

use App\Entity\Subscription;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ShowSubscriptionController extends AbstractController
{


    /**
     *@Route("/subscription/show/{id}", name="subscription_show")
     */
    public function show(Subscription $subscription)
    {

        

        if(!$subscription)
        {
            $this->addFlash("danger","Subscription cannot be found.");
            return $this->redirectToRoute("landing_subscription");
        }

        $keypointsObj = $subscription->getKeyPointId()->getValues(); 
        $keyPoints = []; 

        foreach($keypointsObj as $points){

            $keyPoints[] = $points->getKeyPoint(); 

        }

       
        return $this->render('landing_subscription/show.html.twig', [
            "sub" => $subscription,
            "keyPoints" => $keyPoints
        ]); 
    }
}