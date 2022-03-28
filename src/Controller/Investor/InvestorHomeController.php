<?php

namespace App\Controller\Investor;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvestorHomeController extends AbstractController
{
    /**
     * @Route("/investor/home", name="investor_home")
     */
    public function index(CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $capitalInvestmentAsset = $capitalInvestmentAssetRepository->findOneBy([]);

        $wallet = $investor->getWallet();

        $returnRate = ceil(($wallet->getTotalInterest() * 100) / $wallet->getInitialAmount());

        return $this->render('dashboard/investor/investor_home.html.twig',[
            'capitalInvestmentAsset' => $capitalInvestmentAsset,
            'wallet' => $wallet,
            'investor' => $investor,
            'returnRate' => $returnRate
        ]);
    }
}
