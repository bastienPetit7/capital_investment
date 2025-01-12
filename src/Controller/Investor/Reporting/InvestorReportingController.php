<?php

namespace App\Controller\Investor\Reporting;

use App\Entity\User;
use App\Services\ReportingService\ChartGenerator;
use App\Repository\ReportingMovementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvestorReportingController extends AbstractController
{

    #[Route('investor/reporting', name: 'investor_reporting', methods: ['GET'] )]
    public function index(ReportingMovementRepository $reportingMovementRepository,
                          ChartGenerator $chartGenerator)
    {
        /** @var User $user */
        $user = $this->getUser();

        $investor = $user->getInvestor();

        $wallet = $investor->getWallet();

        $reporting = $wallet->getReporting();

        //HANDLE MOVEMENTS
        $movements = $reportingMovementRepository->findByReportingAndAsc($reporting);

        $chart = $chartGenerator->getChartLine($movements,$wallet);

        $initialAmount = $wallet->getInitialAmount();

        $year = date('Y');

        $chartBar = $chartGenerator->getChartBar($wallet, $year);


        return $this->render('dashboard/investor/reporting/index.html.twig', [
            'investor' => $investor,
            'chart' => $chart,
            'initialAmount' => $initialAmount,
            'year' => $year,
            'reporting' => $reporting,
            'chartBar' => $chartBar,
            'movements' => $movements
        ]);
    }


}