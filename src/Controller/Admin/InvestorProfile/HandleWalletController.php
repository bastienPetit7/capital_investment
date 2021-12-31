<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Form\ActualAmountWalletType;
use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleWalletController extends AbstractController
{
    /**
     * @Route("/admin/customer/investorprofile/handlewallet/{id}", name="admin_customer_investor_profile_handle_wallet")
     */
    public function show(int $id,InvestorRepository $investorRepository,EntityManagerInterface $em, Request $request)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_customer_investor_profile_list");
        }

        $form = $this->createForm(ActualAmountWalletType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $newActualAmount = $form->get('walletActualAmount')->getData();

            $wallet = $investor->getWallet();

            $wallet->setActualAmount($newActualAmount);

            $em->flush();

            $this->addFlash("light","The wallet actual amount has been updated successfully.");

            return $this->redirectToRoute("admin_customer_investor_profile_handle_wallet",['id'=>$id]);

        }

        return $this->render('admin/investor_profile/handle_wallet.html.twig',[
            'investor' => $investor,
            'form' => $form->createView()
        ]);
    }
}