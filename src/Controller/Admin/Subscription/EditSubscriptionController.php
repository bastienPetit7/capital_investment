<?php

namespace App\Controller\Admin\Subscription;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditSubscriptionController extends AbstractController
{
    /**
     * @Route("admin/subscription/edit/{id}", name="admin_subscription_edit")
     */
    public function create(int $id, ImageService $imageService, SubscriptionRepository $subscriptionRepository,Request $request,EntityManagerInterface $em): Response
    {
        $sub = $subscriptionRepository->find($id);

        if(!$sub)
        {
            $this->addFlash("danger","The sub cannot be found.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        $originalImage = $sub->getImagePath();

        $form = $this->createForm(SubscriptionType::class,$sub);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
             /** @var UploadedFile $file */
             $imageFile = $form->get('image')->getData();

             if ($imageFile) {
                 $imageService->editImage($originalImage,$imageFile,$sub);
             }

            $em->flush();

            $this->addFlash("light","The subscription has been edited.");
            return $this->redirectToRoute("admin_subscription_list");
        }

        return $this->render("admin/subscription/edit.html.twig",[
            'sub' => $sub,
            'form' => $form->createView()
        ]);
    }
}