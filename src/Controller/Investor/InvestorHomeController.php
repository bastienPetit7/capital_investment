<?php

namespace App\Controller\Investor;

use App\Entity\User;
use App\Form\ChoiceYearType;
use App\Repository\CapitalInvestmentAssetRepository;
use App\Repository\ReportingMovementRepository;
use App\Repository\WalletRepository;
use App\Services\HomeInvestor\MultipleChartGenerator;
use App\Services\ReportingService\ChartGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Choice;

class InvestorHomeController extends AbstractController
{
    /**
     * @Route("/investor/home/{idWallet?null}", name="investor_home")
     */
    public function index($idWallet,CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository,
                          MultipleChartGenerator $multipleChartGenerator,
                          ReportingMovementRepository $reportingMovementRepository,
                          ChartGenerator $chartGenerator,WalletRepository $walletRepository,Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $capitalInvestmentAsset = $capitalInvestmentAssetRepository->findOneBy([]);

        $wallets = $investor->getWallets();

        $wallet = null;

        if(count($wallets) > 0 && $idWallet === 'null')
        {
            $wallet = $wallets[0];
        }
        elseif(count($wallets) > 0 && $idWallet !== 'null')
        {
            $wallet = $walletRepository->findOneBy([
               'id' => $idWallet,
               'investor' => $investor
            ]);

            if(!$wallet)
            {
                return $this->redirectToRoute('investor_home');
            }
        }

        $returnRate = 0;

        if($wallet->getInitialAmount() > 0)
        {
            $returnRate = ceil(($wallet->getTotalInterest() * 100) / $wallet->getInitialAmount());
        }

        $reporting = $wallet->getReporting();

        //HANDLE MOVEMENTS
        $movements = $reportingMovementRepository->findByReportingAndAsc($reporting);

        $chartLineEvolutionCapital =  $multipleChartGenerator->getChartLineEvolutionCapital($movements,$wallet);

        $chartLineEvolutionEarningInterest =  $multipleChartGenerator->getChartLineEvolutionEarningInterest($movements);

        $chartLineEvolutionRateInterest =  $multipleChartGenerator->getChartLineEvolutionRateInterest($movements);


        //HANDLE MOVEMENTS
        $movements = $reportingMovementRepository->findByReportingAndAsc($reporting);

        $chart = $chartGenerator->getChartLine($movements,$wallet);

        $initialAmount = $wallet->getInitialAmount();
        $year = date('Y');

        $formYear = $this->createForm(ChoiceYearType::class,['year' => $year]);
        $formYear->handleRequest($request);

        $ancre = null;

        if($formYear->isSubmitted() && $formYear->isValid())
        {
            $year = $formYear->get('year')->getData();
            $ancre = 'reportingSmooth';
        }

        $chartBar = $chartGenerator->getChartBar($wallet, $year);


        return $this->render('dashboard/investor/home/index.html.twig',[
            'capitalInvestmentAsset' => $capitalInvestmentAsset,
            'wallet' => $wallet,
            'wallets' => $wallets,
            'investor' => $investor,
            'returnRate' => $returnRate,
            'chartLineEvolutionCapital' => $chartLineEvolutionCapital,
            'chartLineEvolutionEarningInterest' => $chartLineEvolutionEarningInterest,
            'chartLineEvolutionRateInterest' => $chartLineEvolutionRateInterest,
            'chart' => $chart,
            'initialAmount' => $initialAmount,
            'year' => $year,
            'chartBar' => $chartBar,
            'reporting' => $reporting,
            'movements' => $movements,
            'formYear' => $formYear->createView(),
            'ancre' => $ancre
        ]);
    }
}
