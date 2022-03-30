<?php

namespace App\Controller\Investor;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use App\Repository\ReportingMovementRepository;
use App\Services\HomeInvestor\MultipleChartGenerator;
use App\Services\ReportingService\ChartGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvestorHomeController extends AbstractController
{
    /**
     * @Route("/investor/home", name="investor_home")
     */
    public function index(CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository,
                          MultipleChartGenerator $multipleChartGenerator,
                          ReportingMovementRepository $reportingMovementRepository,
                          ChartGenerator $chartGenerator): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $capitalInvestmentAsset = $capitalInvestmentAssetRepository->findOneBy([]);

        $wallet = $investor->getWallet();

        $returnRate = ceil(($wallet->getTotalInterest() * 100) / $wallet->getInitialAmount());

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

        $chartBar = $chartGenerator->getChartBar($wallet, $year);


        return $this->render('dashboard/investor/home/index.html.twig',[
            'capitalInvestmentAsset' => $capitalInvestmentAsset,
            'wallet' => $wallet,
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
            'movements' => $movements
        ]);
    }
}
