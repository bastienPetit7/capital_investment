<?php

namespace App\Controller\Admin\Subscription\Subscription_KeyPoint;

use App\Entity\SubscriptionKeyPoint;
use App\Form\SubscriptionKeyPointType;
use App\Repository\SubscriptionKeyPointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subscription/keypoint")
 */
class SubscriptionKeyPointController extends AbstractController
{
    /**
     * @Route("/", name="subscription_key_point_index", methods={"GET"})
     */
    public function index(SubscriptionKeyPointRepository $subscriptionKeyPointRepository): Response
    {
        return $this->render('admin/subscription_key_point/index.html.twig', [
            'subscription_key_points' => $subscriptionKeyPointRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subscription_key_point_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscriptionKeyPoint = new SubscriptionKeyPoint();
        $form = $this->createForm(SubscriptionKeyPointType::class, $subscriptionKeyPoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subscriptionKeyPoint);
            $entityManager->flush();

            return $this->redirectToRoute('subscription_key_point_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/subscription_key_point/new.html.twig', [
            'subscription_key_point' => $subscriptionKeyPoint,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_key_point_show", methods={"GET"})
     */
    public function show(SubscriptionKeyPoint $subscriptionKeyPoint): Response
    {
        return $this->render('admin/subscription_key_point/show.html.twig', [
            'subscription_key_point' => $subscriptionKeyPoint,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subscription_key_point_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SubscriptionKeyPoint $subscriptionKeyPoint, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubscriptionKeyPointType::class, $subscriptionKeyPoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('subscription_key_point_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/subscription_key_point/edit.html.twig', [
            'subscription_key_point' => $subscriptionKeyPoint,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="subscription_key_point_delete", methods={"POST"})
     */
    public function delete(Request $request, SubscriptionKeyPoint $subscriptionKeyPoint, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscriptionKeyPoint->getId(), $request->request->get('_token'))) {
            $entityManager->remove($subscriptionKeyPoint);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscription_key_point_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
