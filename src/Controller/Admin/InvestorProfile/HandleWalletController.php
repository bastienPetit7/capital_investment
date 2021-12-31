<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Repository\InvestorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HandleWalletController extends AbstractController
{
    /**
     * @Route("/admin/customer/investorprofile/handlewallet/{id}", name="admin_customer_investor_profile_handle_wallet")
     */
    public function show(int $id,InvestorRepository $investorRepository)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_customer_investor_profile_list");
        }

        return $this->render('admin/investor_profile/handle_wallet.html.twig',[
            'investor' => $investor
        ]);
    }
}