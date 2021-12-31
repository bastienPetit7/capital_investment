<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Repository\InvestorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HandleSettingsController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlesettings/{id}", name="admin_investor_profile_handle_settings")
     */
    public function show(int $id,InvestorRepository $investorRepository)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        return $this->render('admin/investor_profile/handle_settings.html.twig',[
            'investor' => $investor
        ]);
    }
}