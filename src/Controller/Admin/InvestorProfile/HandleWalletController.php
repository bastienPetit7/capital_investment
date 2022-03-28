<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Form\DepositAmountType;
use App\Form\EditWalletCurrencyType;
use App\Form\EditWalletInterestCompoundOrClassicType;
use App\Form\EditWalletInterestRatesType;
use App\Form\EditWalletInterestRecoveryFoundType;
use App\Form\EditWalletStatusType;
use App\Form\EditWalletTotalActifType;
use App\Form\SimulateEarningType;
use App\Form\WalletType;
use App\Form\WithdrawalAmountType;
use App\Repository\InvestorRepository;
use App\Repository\ReportingMovementRepository;
use App\Services\ReportingService\ChartGenerator;
use App\Services\ReportingService\DepositMovementPersister;
use App\Services\ReportingService\EarningMovementPersister;
use App\Services\ReportingService\WithdrawalMovementPersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleWalletController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlewallet/{id}", name="admin_investor_profile_handle_wallet")
     */
    public function show(int $id,InvestorRepository $investorRepository,EntityManagerInterface $em,
                         Request $request,ReportingMovementRepository $reportingMovementRepository,
                         DepositMovementPersister $depositMovementPersister,WithdrawalMovementPersister $withdrawalMovementPersister,
                         EarningMovementPersister $earningMovementPersister,ChartGenerator $chartGenerator)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $wallet = $investor->getWallet();

        $reporting = $wallet->getReporting();

        //FORM INITIALIZE WALLET
        $form = $this->createForm(WalletType::class,$investor->getWallet());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $wallet->setActualAmount($wallet->getInitialAmount());
            $em->flush();

            $this->addFlash("light","The wallet has been initialized successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM EDIT INTEREST TYPE
        $formEditInterestType = $this->createForm(EditWalletInterestCompoundOrClassicType::class);

        $formEditInterestType->handleRequest($request);

        if($formEditInterestType->isSubmitted() && $formEditInterestType->isValid())
        {
            $interestType = $formEditInterestType->get('interestType')->getData();

            $wallet->setInterestType($interestType);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM EDIT STATUS
        $formEditStatusType = $this->createForm(EditWalletStatusType::class);

        $formEditStatusType->handleRequest($request);

        if($formEditStatusType->isSubmitted() && $formEditStatusType->isValid())
        {
            $status = $formEditStatusType->get('status')->getData();

            $wallet->setStatus($status);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM INTEREST RATES
        $formEditInterestRateType = $this->createForm(EditWalletInterestRatesType::class);

        $formEditInterestRateType->handleRequest($request);

        if($formEditInterestRateType->isSubmitted() && $formEditInterestRateType->isValid())
        {
            $interestRates = $formEditInterestRateType->get('interestRates')->getData();

            $wallet->setInterestRates($interestRates);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM DEPOSIT
        $formDepositAmount = $this->createForm(DepositAmountType::class);

        $formDepositAmount->handleRequest($request);

        if($formDepositAmount->isSubmitted() && $formDepositAmount->isValid())
        {
            $depositAmount = $formDepositAmount->get('amount')->getData();

            $month = $formDepositAmount->get('month')->getData();

            $year = $formDepositAmount->get('year')->getData();

            $depositMovementPersister->processCreation($month,$year,$depositAmount,$reporting,$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM WITHDRAWAL
        $formWithdrawalAmount = $this->createForm(WithdrawalAmountType::class);

        $formWithdrawalAmount->handleRequest($request);

        if($formWithdrawalAmount->isSubmitted() && $formWithdrawalAmount->isValid())
        {
            $withdrawalAmount = $formWithdrawalAmount->get('amount')->getData();

            $month = $formWithdrawalAmount->get('month')->getData();

            $year = $formWithdrawalAmount->get('year')->getData();

            $withdrawalMovementPersister->processCreation($month,$year,$withdrawalAmount,$reporting,$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM SIMULATE EARNING
        $formSimulateEarning = $this->createForm(SimulateEarningType::class);

        $formSimulateEarning->handleRequest($request);

        if($formSimulateEarning->isSubmitted() && $formSimulateEarning->isValid())
        {
            $month = $formSimulateEarning->get('month')->getData();

            $year = $formSimulateEarning->get('year')->getData();

            $earningMovementPersister->processCreation($month,$year,$reporting,$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM Interest Recovery Found
        $formInterestRecoveryFound = $this->createForm(EditWalletInterestRecoveryFoundType::class,[
            'interestRecoveryFound' => $wallet->getInterestRecoveryFound()
        ]);

        $formInterestRecoveryFound->handleRequest($request);

        if($formInterestRecoveryFound->isSubmitted() && $formInterestRecoveryFound->isValid())
        {
            $interestRecoveryFound = $formInterestRecoveryFound->get('interestRecoveryFound')->getData();

            $wallet->setInterestRecoveryFound($interestRecoveryFound);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM Total Actif
        $formTotalActif = $this->createForm(EditWalletTotalActifType::class,[
            'totalActif' => $wallet->getTotalActif()
        ]);

        $formTotalActif->handleRequest($request);

        if($formTotalActif->isSubmitted() && $formTotalActif->isValid())
        {
            $totalActif = $formTotalActif->get('totalActif')->getData();

            $wallet->setTotalActif($totalActif);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM Total Actif
        $formCurrency = $this->createForm(EditWalletCurrencyType::class,[
            'currency' => $wallet->getCurrency()
        ]);

        $formCurrency->handleRequest($request);

        if($formCurrency->isSubmitted() && $formCurrency->isValid())
        {
            $currency = $formCurrency->get('currency')->getData();

            $wallet->setCurrency($currency);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //HANDLE MOVEMENTS
        $movements = $reportingMovementRepository->findByReportingAndAsc($reporting);

        $chartLine = $chartGenerator->getChartLine($movements,$wallet);

        $year = date('Y');

        $chartBar = $chartGenerator->getChartBar($wallet, $year);

        $initialAmount = $wallet->getInitialAmount();

        return $this->render('admin/investor_profile/handle_wallet.html.twig',[
            'investor' => $investor,
            'form' => $form->createView(),
            'formEditInterestRateType' => $formEditInterestRateType->createView(),
            'formEditStatus' => $formEditStatusType->createView(),
            'formEditInterest' => $formEditInterestType->createView(),
            'formWithdrawalAmount' => $formWithdrawalAmount->createView(),
            'formDepositAmount' => $formDepositAmount->createView(),
            'formSimulateEarning' => $formSimulateEarning->createView(),
            'formInterestRecoveryFound' => $formInterestRecoveryFound->createView(),
            'formTotalActif' => $formTotalActif->createView(),
            'formCurrency' => $formCurrency->createView(),
            'movements' => $movements,
            'chartLine' => $chartLine,
            'chartBar' => $chartBar,
            'reporting' => $reporting,
            'year' => $year,
            'initialAmount' => $initialAmount,
        ]);
    }
}