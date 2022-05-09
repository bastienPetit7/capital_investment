<?php

namespace App\Controller\Investor\Position;

use App\Repository\PositionRepository;
use DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InvestorPositionController extends AbstractController
{


    #[Route('investor/position/all', name: 'investor_position', methods: ['GET'])]
    public function positionAll(PositionRepository $positionRepository): Response
    {

        $positions = $positionRepository->findBy([],[
            'publishedAt' => 'DESC'
        ]);

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'date' => 'All'
        ]);
    }

    #[Route('investor/position/week', name: 'investor_position_week', methods: ['GET'])]
    public function positionOfTheWeek(PositionRepository $positionRepository): Response
    {

        $date = new DateTime();

        $positions = $positionRepository->findBy([
            'weekOfCreation' => $date->format("W")
        ],[
            'publishedAt' => 'DESC'
        ]);

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'date' => 'Week ' . $date->format("W")
        ]);
    }

    #[Route('investor/position/day', name: 'investor_position_day', methods: ['GET'])]
    public function positionOfTheDay(PositionRepository $positionRepository): Response
    {

        $date = new DateTime();

        $positions = $positionRepository->findBy([
            'publishedAt' => $date
        ],[
            'publishedAt' => 'DESC'
        ]);

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'date' => $date->format('d-M-Y')
        ]);
    }

    


}