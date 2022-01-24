<?php

namespace App\Controller\Admin\Subscription;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteSubscriptionController extends AbstractController
{

    /**
     * @Route("admin/subscription/delete/{id}", name="admin_subscription_delete", methods={"POST"})
     */
    public function delete(Request $request, Subscription $subscription, EntityManagerInterface $em): Response
    {


        if($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->request->get('_token'))) {
            $em->remove($subscription);
            $em->flush();
        }

        return $this->redirectToRoute('admin_subscription_list', [], Response::HTTP_SEE_OTHER);


    }



}