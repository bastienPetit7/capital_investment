<?php

namespace App\Controller\ApiReactNative\Investor;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use App\Repository\PositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiHomeController extends AbstractController
{
    /**
     * @Route("/api/getdata", name="api_investor_get_data")
     */
    public function home(CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository,PositionRepository $positionRepository): JsonResponse
    {
        //USER, INVESTOR, WALLET
        /** @var User $user */
        $user = $this->getUser();
        $investor = $user->getInvestor();
        $wallets = null;

        if($investor != null)
        {
            $wallets = $investor->getWallets();
        }

        //INFORMATIONS SUR LA SOCIETE CAPITAL INVESTMENT
        $capitalInvestmentAsset = $capitalInvestmentAssetRepository->findOneBy([]);

        //TRACKING, POSITION
        $positions = $positionRepository->findBy([],[
            'publishedAt' => 'DESC'
        ]);
        $totalPips = 0;
        $nombreDePositions = 0;

        foreach ($positions as $position)
        {
            if($position->getPips())
            {
                $totalPips += $position->getPips();
            }

            if($position->getPositionState())
            {
                $nombreDePositions += 1;
            }
        }

        //DATA ENVOYE VERS REACT NATIVE
        $data = [
            'user' => $user,
            'contracts' => $wallets,
            'cleo' => $capitalInvestmentAsset,
            'tracking' => [
                'positions' => $positions,
                'totalPips' => $totalPips,
                'nombreDePositions' => $nombreDePositions,
            ]
        ];

        return $this->json($data,200, [],['groups' => 'user:read']);
    }
}