<?php

namespace App\Controller\Admin\Subscription;

use App\Dictionary\ActiveSubscription;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActivateSubscriptionController extends AbstractController
{


    /**
     * Undocumented function
     *@Route("/admin/subscription/activate/{id}", name="admin_subscription_activate")
     */
    public function activateSubscription(int $id, SubscriptionRepository $subscriptionRepository, EntityManagerInterface $em)
    {

        $sub = $subscriptionRepository->find($id);

        if(!$sub)
        {
            $this->addFlash("danger","Subscription cannot be found.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        $sub->setIsActive("1"); 
        $em->flush($sub); 


        $this->addFlash("success", "Subscription has been successfully activated "); 
        
        return $this->redirectToRoute('admin_subscription_list'); 
    }


    /**
     * Undocumented function
     *@Route("/admin/subscription/unactivate/{id}", name="admin_subscription_unactivate")
     */
    public function unactivateSubscription(int $id, SubscriptionRepository $subscriptionRepository, EntityManagerInterface $em)
    {


        $sub = $subscriptionRepository->find($id);

        if(!$sub)
        {
            $this->addFlash("danger","Subscription cannot be found.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        $sub->setIsActive("0"); 
        $em->flush($sub); 


        $this->addFlash("success", "Subscription has been successfully unactivated "); 
        
        return  $this->redirectToRoute('admin_subscription_list');

    }

}