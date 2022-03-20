<?php

namespace App\Services\ReportingService;

use App\Dictionary\Movement;
use App\Dictionary\ProfileInvestorRateType;
use App\Entity\CashOut;
use App\Entity\InterestEarn;
use App\Entity\Reporting;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManagerInterface;

class EarningMovementPersister
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processCreation($month,$year,Reporting $reporting,Wallet $wallet)
    {
        $date = new \DateTime('01-' . $month .'-' . $year);

        $actualWalletAmount = $wallet->getActualAmount();
        $earningAmount = ($actualWalletAmount * $wallet->getInterestRates()) / 100;
        $newWalletAmount = $actualWalletAmount + $earningAmount;

        //handle Reporting Movement
        $reportingMovement = new ReportingMovement();
        $reportingMovement->setCreatedAt($date);
        $reportingMovement->setName(Movement::EARNING);
        $reportingMovement->setInterestRates($wallet->getInterestRates());
        $reportingMovement->setMonth($month);
        $reportingMovement->setYear($year);
        $reportingMovement->setReporting($reporting);
        $reportingMovement->setWalletAmountBeforeMovement($actualWalletAmount);
        $reportingMovement->setWalletAmountAfterMovement($newWalletAmount);

        //handle earning
        $earning = new InterestEarn();
        $earning->setAmount($earningAmount);
        $earning->setReportingMovement($reportingMovement);

        //handle Wallet
        $wallet->setActualAmount($newWalletAmount);

        //handle persist
        $this->em->persist($reportingMovement);
        $this->em->persist($earning);

        //if interest type is CLASSIC , we must create a withdrawal of earning
        if($wallet->getInterestType() === ProfileInvestorRateType::INVESTOR_INTEREST_CLASSIC)
        {
            $secondReportingMovement = new ReportingMovement();
            $secondReportingMovement->setCreatedAt($date);
            $secondReportingMovement->setName(Movement::WITHDRAWAL);
            $secondReportingMovement->setReporting($reporting);
            $secondReportingMovement->setWalletAmountBeforeMovement($newWalletAmount);
            $secondReportingMovement->setWalletAmountAfterMovement($actualWalletAmount);

            //handle cash in
            $cashOut = new CashOut();
            $cashOut->setAmount($earningAmount);
            $cashOut->setReportingMovement($secondReportingMovement);

            //handle Wallet
            $wallet->setActualAmount($actualWalletAmount);

            $this->em->persist($secondReportingMovement);
            $this->em->persist($cashOut);
        }

    }
}