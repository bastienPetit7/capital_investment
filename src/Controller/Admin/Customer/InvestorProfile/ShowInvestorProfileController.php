<?php

namespace App\Controller\Admin\Customer\InvestorProfile;

use App\Repository\InvestorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowInvestorProfileController extends AbstractController
{
    /**
     * @Route("/admin/customer/investorprofile/show/{id}", name="admin_customer_investor_profile_show")
     */
    public function show(int $id,InvestorRepository $investorRepository)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_customer_investor_profile_list");
        }

        return $this->render('admin/customer/investor_profile/show.html.twig',[
            'investor' => $investor
        ]);
    }
}