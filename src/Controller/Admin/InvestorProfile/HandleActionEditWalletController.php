<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Repository\WalletRepository;
use App\Services\ReportingService\BonusMovementPersister;
use App\Services\ReportingService\DepositMovementPersister;
use App\Services\ReportingService\EarningMovementPersister;
use App\Services\ReportingService\WithdrawalMovementPersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleActionEditWalletController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlewallet/editinterest/{id}", name="admin_investor_profile_handle_wallet_edit_interest")
     */
    public function editInterestType($id,Request $request,WalletRepository $walletRepository,EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_interest_compound_or_classic');


        $interestType = $data['interestType'];

        if($interestType)
        {
            $wallet->setInterestType($interestType);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

           return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/editstatustype/{id}", name="admin_investor_profile_handle_wallet_edit_status_type")
     */
    public function editStatusType($id,Request $request,WalletRepository $walletRepository,EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_status');

        $status = $data['status'];

        if($status)
        {
            $wallet->setStatus($status);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

           return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/editinterestrates/{id}", name="admin_investor_profile_handle_wallet_edit_interest_rates")
     */
    public function editInterest($id,Request $request,WalletRepository $walletRepository,EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_interest_rates');


        $interestRates = $data['interestRates'];

        if($interestRates)
        {
            $wallet->setInterestRates($interestRates);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

           return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/editdepositamount/{id}", name="admin_investor_profile_handle_wallet_edit_deposit_amount")
     */
    public function editDepositAmount($id,Request $request,WalletRepository $walletRepository,
                                      EntityManagerInterface $em,DepositMovementPersister $depositMovementPersister)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('deposit_amount');

        $amount = $data['amount'] * 100;

        $month = $data['month'];

        $year = $data['year'];

        if($amount)
        {
            $depositMovementPersister->processCreation($month,$year,$amount,$wallet->getReporting(),$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

           return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/editbonus/{id}", name="admin_investor_profile_handle_wallet_edit_bonus")
     */
    public function editBonus($id,Request $request,WalletRepository $walletRepository,
                                      EntityManagerInterface $em,BonusMovementPersister $bonusMovementPersister)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('bonus_amount');

        $amount = $data['amount'] * 100;

        $month = $data['month'];

        $year = $data['year'];

        if($amount)
        {
            $bonusMovementPersister->processCreation($month,$year,$amount,$wallet->getReporting(),$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

        return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/editwithdrawal/{id}", name="admin_investor_profile_handle_wallet_edit_withdrawal")
     */
    public function editWithdrawal($id,Request $request,WalletRepository $walletRepository,
                              EntityManagerInterface $em,WithdrawalMovementPersister $withdrawalMovementPersister)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('withdrawal_amount');

        $amount = $data['amount'] * 100;

        $month = $data['month'];

        $year = $data['year'];

        if($amount)
        {
            $withdrawalMovementPersister->processCreation($month,$year,$amount,$wallet->getReporting(),$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

           return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }


    /**
     * @Route("/admin/investorprofile/handlewallet/editsimulateearning/{id}", name="admin_investor_profile_handle_wallet_edit_simulate_earning")
     */
    public function editSimulateEarning($id,Request $request,WalletRepository $walletRepository,
                                   EntityManagerInterface $em,EarningMovementPersister $earningMovementPersister)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('simulate_earning');

        $month = $data['month'];

        $year = $data['year'];

        if($month)
        {
            $earningMovementPersister->processCreation($month,$year,$wallet->getReporting(),$wallet);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

        return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }


    /**
     * @Route("/admin/investorprofile/handlewallet/editinterestRecoveryFound/{id}", name="admin_investor_profile_handle_wallet_edit_interest_recovery_found")
     */
    public function editInterestRecoveryFound($id,Request $request,WalletRepository $walletRepository,
                                        EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_interest_recovery_found');

        $interestRecoveryFound = $data['interestRecoveryFound'] * 100;

        if($interestRecoveryFound)
        {
            $wallet->setInterestRecoveryFound($interestRecoveryFound);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

        return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);

    }

    /**
     * @Route("/admin/investorprofile/handlewallet/edittotalactif/{id}", name="admin_investor_profile_handle_wallet_edit_total_actif")
     */
    public function editTotalActif($id,Request $request,WalletRepository $walletRepository,
                                              EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_total_actif');

        $totalActif = $data['totalActif'] * 100;

        if($totalActif)
        {
            $wallet->setTotalActif($totalActif);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

        return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);
    }


    /**
     * @Route("/admin/investorprofile/handlewallet/editcurrency/{id}", name="admin_investor_profile_handle_wallet_edit_currency")
     */
    public function editCurrency($id,Request $request,WalletRepository $walletRepository,
                                   EntityManagerInterface $em)
    {
        $wallet = $walletRepository->find($id);

        if(!$wallet)
        {
            $this->addFlash('danger','Wallet does not exist');
            return $this->redirectToRoute('admin_investor_profile_list');
        }

        $data = $request->request->get('edit_wallet_currency');

        $currency = $data['currency'];

        if($currency)
        {
            $wallet->setCurrency($currency);

            $em->flush();

            $this->addFlash("light","The wallet has been edited successfully.");
        }

        return $this->redirectToRoute("admin_investor_profile_handle_wallet",['id'=>$wallet->getInvestor()->getId(),'idWallet' => $id]);
    }
}