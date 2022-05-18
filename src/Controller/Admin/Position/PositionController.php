<?php

namespace App\Controller\Admin\Position;

use App\Entity\Position;
use App\Form\PositionsType;
use App\Repository\PositionRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/position')]
class PositionController extends AbstractController
{
    #[Route('/', name: 'position_index', methods: ['GET'])]
    public function index(PositionRepository $positionRepository): Response
    {
        $positions = $positionRepository->findBy([], ['publishedAt' => 'desc']);
        
        return $this->render('admin/position/index.html.twig', [
            'positions' => $positions
        ]);
    }

    #[Route('/new', name: 'position_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $entityManager): Response
    {
        $position = new Position();
        $form = $this->createForm(PositionsType::class, $position);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = $position->getPublishedAt()->format('Y-m-d');
            $good_format=strtotime ($date);
            $weekOfCreation = date('W',$good_format);
            $position->setWeekOfCreation($weekOfCreation); 
            $entityManager->persist($position);
            $entityManager->flush();

            return $this->redirectToRoute('position_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/position/new.html.twig', [
            'position' => $position,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'position_show', methods: ['GET'])]
    public function show(Position $position): Response
    {
        return $this->render('admin/position/show.html.twig', [
            'position' => $position,
        ]);
    }

    #[Route('/{id}/edit', name: 'position_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        Position $position, 
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PositionsType::class, $position);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime(); 
            $weekOfCreation = $date->format("W"); 
            $position->setWeekOfCreation($weekOfCreation); 

            $entityManager->flush();

            return $this->redirectToRoute('position_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/position/edit.html.twig', [
            'position' => $position,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'position_delete', methods: ['POST'])]
    public function delete(
        Request $request, 
        Position $position, 
        EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$position->getId(), $request->request->get('_token'))) {
            $entityManager->remove($position);
            $entityManager->flush();
        }

        return $this->redirectToRoute('position_index', [], Response::HTTP_SEE_OTHER);
    }
}
