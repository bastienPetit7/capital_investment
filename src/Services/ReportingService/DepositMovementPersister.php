<?php

namespace App\Services\ReportingService;

use App\Dictionary\Movement;
use App\Entity\CashIn;
use App\Entity\Reporting;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;

class DepositMovementPersister
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processCreation($depositAmount,Reporting $reporting,Wallet $wallet)
    {
        $actualWalletAmount = $wallet->getActualAmount();
        $newWalletAmount = $actualWalletAmount + $depositAmount;

        //handle Reporting Movement
        $reportingMovement = new ReportingMovement();
        $reportingMovement->setName(Movement::DEPOSIT);
        $reportingMovement->setReporting($reporting);
        $reportingMovement->setWalletAmountBeforeMovement($actualWalletAmount);
        $reportingMovement->setWalletAmountAfterMovement($newWalletAmount);

        //handle cash in
        $cashIn = new CashIn();
        $cashIn->setAmount($depositAmount);
        $cashIn->setReportingMovement($reportingMovement);

        //handle Wallet
        $wallet->setActualAmount($newWalletAmount);

        //handle persist
        $this->em->persist($reportingMovement);
        $this->em->persist($cashIn);
    }
}