<?php

namespace App\Services\ReportingService;

use App\Dictionary\Movement;
use App\Entity\CashOut;
use App\Entity\Reporting;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;

class WithdrawalMovementPersister
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processCreation($month,$year,$withdrawalAmount,Reporting $reporting,Wallet $wallet)
    {
        $actualWalletAmount = $wallet->getActualAmount();
        $newWalletAmount = $actualWalletAmount - $withdrawalAmount;
        $date = new \DateTime('01-' . $month .'-' . $year);
        //handle Reporting Movement
        $reportingMovement = new ReportingMovement();
        $reportingMovement->setCreatedAt($date);
        $reportingMovement->setName(Movement::WITHDRAWAL);
        $reportingMovement->setInterestRates($wallet->getInterestRates());
        $reportingMovement->setReporting($reporting);
        $reportingMovement->setMonth($month);
        $reportingMovement->setYear($year);
        $reportingMovement->setWalletAmountBeforeMovement($actualWalletAmount);
        $reportingMovement->setWalletAmountAfterMovement($newWalletAmount);

        //handle cash in
        $cashOut = new CashOut();
        $cashOut->setAmount($withdrawalAmount);
        $cashOut->setReportingMovement($reportingMovement);

        //handle Wallet
        $wallet->setActualAmount($newWalletAmount);

        //handle persist
        $this->em->persist($reportingMovement);
        $this->em->persist($cashOut);
    }
}