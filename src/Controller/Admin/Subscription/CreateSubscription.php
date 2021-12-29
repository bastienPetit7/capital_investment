<?php

namespace App\Controller\Admin\Subscription;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateSubscription extends AbstractController
{
    /**
     * @Route("admin/subscription/create", name="admin_subscription_create")
     */
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        $sub = new Subscription();

        $form = $this->createForm(SubscriptionType::class,$sub);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($sub);
            $em->flush();

            $this->addFlash("light","A subscription has been created.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        return $this->render("admin/subscription/create.html.twig",[
            'sub' => $sub,
            'form' => $form->createView()
        ]);
    }
}