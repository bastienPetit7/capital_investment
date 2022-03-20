<?php

namespace App\Controller\Investor\Position;

use App\Repository\PositionRepository;
use DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InvestorPositionController extends AbstractController
{


    #[Route('investor/position', name: 'investor_position', methods: ['GET'])]
    public function positionOfTheDay(PositionRepository $positionRepository): Response
    {

        $positions = $positionRepository->findActives(); 

        $positionsOfTheDay = []; 
        $now = new DateTime();
        $today = $now->format('Y-M-d');

        foreach($positions as $position){

            if($position->getCreatedAt()->format('Y-M-d') === $today){

                $positionsOfTheDay[] = $position; 

            }
        }


        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positionsOfTheDay
        ]);
    }

    


}