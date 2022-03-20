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

    public function processCreation($withdrawalAmount,Reporting $reporting,Wallet $wallet)
    {
        $actualWalletAmount = $wallet->getActualAmount();
        $newWalletAmount = $actualWalletAmount - $withdrawalAmount;

        //handle Reporting Movement
        $reportingMovement = new ReportingMovement();
        $reportingMovement->setName(Movement::WITHDRAWAL);
        $reportingMovement->setReporting($reporting);
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