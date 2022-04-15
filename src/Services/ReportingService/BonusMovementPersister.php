<?php

namespace App\Services\ReportingService;

use App\Dictionary\Movement;
use App\Entity\Bonus;
use App\Entity\Reporting;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;

class BonusMovementPersister
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processCreation($month,$year,$bonusAmount,Reporting $reporting,Wallet $wallet)
    {
        $actualWalletAmount = $wallet->getActualAmount();
        $newWalletAmount = $actualWalletAmount + $bonusAmount;

        $date = new \DateTime('01-' . $month .'-' . $year);

        //handle Reporting Movement
        $reportingMovement = new ReportingMovement();
        $reportingMovement->setCreatedAt($date);
        $reportingMovement->setName(Movement::BONUS);
        $reportingMovement->setInterestRates($wallet->getInterestRates());
        $reportingMovement->setMonth($month);
        $reportingMovement->setYear($year);
        $reportingMovement->setReporting($reporting);
        $reportingMovement->setWalletAmountBeforeMovement($actualWalletAmount);
        $reportingMovement->setWalletAmountAfterMovement($newWalletAmount);

        //handle cash in
        $bonus = new Bonus();
        $bonus->setAmount($bonusAmount);
        $bonus->setReportingMovement($reportingMovement);

        //handle Wallet
        $wallet->setActualAmount($newWalletAmount);

        //handle persist
        $this->em->persist($reportingMovement);
        $this->em->persist($bonus);
    }
}