<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Entity\Reporting;
use App\Entity\Wallet;
use App\Form\BonusAmountType;
use App\Form\ChoiceYearType;
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
use App\Repository\WalletRepository;
use App\Services\ReportingService\ChartGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleWalletController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlewallet/{id}/{idWallet?null}", name="admin_investor_profile_handle_wallet")
     */
    public function show(int $id,$idWallet,InvestorRepository $investorRepository,EntityManagerInterface $em,
                         Request $request,ReportingMovementRepository $reportingMovementRepository,ChartGenerator $chartGenerator,WalletRepository $walletRepository)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $wallets = $investor->getWallets();


        if($idWallet === 'null')
        {
            $wallet = new Wallet();

            $reporting = new Reporting();
        }
        else
        {
            $wallet = $walletRepository->find($idWallet);

            $reporting = $wallet->getReporting();
        }

        if(count($wallets) > 0 && $idWallet === 'null')
        {
            $wallet = $wallets[0];
            $reporting = $wallet->getReporting();
        }

        //FORM INITIALIZE WALLET
        $form = $this->createForm(WalletType::class,$wallet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $wallet->setActualAmount($wallet->getInitialAmount());
            $wallet->setOriginInitialAmount($wallet->getInitialAmount());

            $wallet->setInvestor($investor);
            $reporting->setWallet($wallet);
            $em->persist($wallet);
            $em->persist($reporting);
            $em->flush();

            $this->addFlash("light","The wallet has been initialized successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id]);
        }

        //FORM EDIT INTEREST TYPE
        $formEditInterestType = $this->createForm(EditWalletInterestCompoundOrClassicType::class,['interestType' => $wallet->getInterestType()]);
        //FORM EDIT STATUS
        $formEditStatusType = $this->createForm(EditWalletStatusType::class,['status' => $wallet->getStatus()]);
        //FORM INTEREST RATES
        $formEditInterestRateType = $this->createForm(EditWalletInterestRatesType::class,['interestRates' => $wallet->getInterestRates()]);
        //FORM DEPOSIT
        $formDepositAmount = $this->createForm(DepositAmountType::class);
        //FORM BONUS
        $formBonusAmount = $this->createForm(BonusAmountType::class);
        //FORM WITHDRAWAL
        $formWithdrawalAmount = $this->createForm(WithdrawalAmountType::class);
        //FORM SIMULATE EARNING
        $formSimulateEarning = $this->createForm(SimulateEarningType::class);
        //FORM Interest Recovery Found
        $formInterestRecoveryFound = $this->createForm(EditWalletInterestRecoveryFoundType::class,['interestRecoveryFound' => $wallet->getInterestRecoveryFound()]);
        //FORM Total Actif
        $formTotalActif = $this->createForm(EditWalletTotalActifType::class,['totalActif' => $wallet->getTotalActif()]);
        //FORM Currency
        $formCurrency = $this->createForm(EditWalletCurrencyType::class,['currency' => $wallet->getCurrency()]);

        $movements = null;
        $chartLine = null;
        $chartBar = null;
        $year = date('Y');

        $formYear = $this->createForm(ChoiceYearType::class,['year' => $year]);
        $formYear->handleRequest($request);

        if($formYear->isSubmitted() && $formYear->isValid())
        {
            $year = $formYear->get('year')->getData();
        }

        //HANDLE MOVEMENTS
        if($reporting->getWallet())
        {
            $movements = $reportingMovementRepository->findByReportingAndAsc($reporting);
            $chartLine = $chartGenerator->getChartLine($movements,$wallet);
            $chartBar = $chartGenerator->getChartBar($wallet, $year);
        }

        $initialAmount = $wallet->getInitialAmount();


        return $this->render('admin/investor_profile/handle_wallet.html.twig',[
            'wallets' => $wallets,
            'investor' => $investor,
            'wallet' => $wallet,
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
            'formBonusAmount' => $formBonusAmount->createView(),
            'formYear' => $formYear->createView()
        ]);
    }


    /**
     * @Route("/admin/investorprofile/addnewwallet/{id}", name="admin_investor_profile_create_new_wallet")
     */
    public function createNewWallet(int $id,InvestorRepository $investorRepository,EntityManagerInterface $em,Request $request)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $wallet = new Wallet();

        //FORM INITIALIZE WALLET
        $form = $this->createForm(WalletType::class,$wallet);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $wallet->setActualAmount($wallet->getInitialAmount());
            $wallet->setOriginInitialAmount($wallet->getInitialAmount());

            $wallet->setInvestor($investor);

            $reporting = new Reporting();

            $reporting->setWallet($wallet);
            $em->persist($wallet);
            $em->persist($reporting);
            $em->flush();

            $this->addFlash("light","The wallet has been initialized successfully.");

            return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$id,'idWallet' => $wallet->getId()]);
        }

        return $this->render('admin/investor_profile/add_new_wallet.html.twig',[
            'investor' => $investor,
            'wallet' => $wallet,
            'form' => $form->createView(),
        ]);
    }
}