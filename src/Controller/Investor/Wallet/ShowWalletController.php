<?php

namespace App\Controller\Investor\Wallet;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowWalletController extends AbstractController
{
    /**
     * @Route("/investor/wallet/list", name="investor_wallet_list")
     */
    public function index(): Response
    {
        return $this->render('dashboard/investor/wallet/list.html.twig');
    }
}
