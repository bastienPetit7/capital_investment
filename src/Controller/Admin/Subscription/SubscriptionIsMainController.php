<?php

namespace App\Controller\Admin\Subscription;

use App\Dictionary\ActiveSubscription;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriptionIsMainController extends AbstractController
{


    /**
     * Undocumented function
     *@Route("/admin/subscription/isMain/{id}", name="admin_subscription_isMain")
     */
    public function isMainSubscription(int $id, SubscriptionRepository $subscriptionRepository, EntityManagerInterface $em)
    {

        $sub = $subscriptionRepository->find($id);

        if(!$sub)
        {
            $this->addFlash("danger","Subscription cannot be found.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        $sub->setIsMain("1"); 
        $em->flush($sub); 


        $this->addFlash("success", "Subscription has been successfully turned to Main "); 
        
        return $this->redirectToRoute('admin_subscription_list'); 
    }


    /**
     * Undocumented function
     *@Route("/admin/subscription/isNormal/{id}", name="admin_subscription_isNormal")
     */
    public function isNormalSubscription(int $id, SubscriptionRepository $subscriptionRepository, EntityManagerInterface $em)
    {


        $sub = $subscriptionRepository->find($id);

        if(!$sub)
        {
            $this->addFlash("danger","Subscription cannot be found.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        $sub->setIsMain("0"); 
        $em->flush($sub); 


        $this->addFlash("success", "Subscription has been successfully turned to Normal "); 
        
        return  $this->redirectToRoute('admin_subscription_list');

    }

}