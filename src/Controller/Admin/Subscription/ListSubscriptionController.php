<?php

namespace App\Controller\Admin\Subscription;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class ListSubscriptionController extends AbstractController
{
    /**
     * @Route("admin/subscription/list", name="admin_subscription_list")
     */
    public function list(SubscriptionRepository $subscriptionRepository): Response
    {
        $subs = $subscriptionRepository->findAll();
        
        
        foreach( $subs as $sub){

           $keyPointsArr = []; 

           foreach($sub->getKeyPointId()->getValues() as $points){

            
           $keyPointsArr[] = $points->getKeyPoint();
            
           }

           $sub->{'keyPoints'} = $keyPointsArr; 
           
        }


        return $this->render("admin/subscription/list.html.twig",[
            'subs' => $subs
        ]);
    }
}