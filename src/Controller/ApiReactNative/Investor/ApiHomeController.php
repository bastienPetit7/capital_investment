<?php

namespace App\Controller\ApiReactNative\Investor;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiHomeController extends AbstractController
{
    /**
     * @Route("/api/getdata", name="api_investor_get_data")
     */
    public function home(CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository): JsonResponse
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

        //DATA ENVOYE VERS REACT NATIVE
        $data = [
            'user' => $user,
            'contracts' => $wallets,
            'cleo' => $capitalInvestmentAsset,
        ];

        return $this->json($data,200, [],['groups' => 'user:read']);
    }
}