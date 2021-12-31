<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Dictionary\AvailableStatusMode;
use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class GhostModeController extends AbstractController
{

    /**
     * @Route("/admin/customer/investorprofile/activate/{id}", name="admin_investor_edit_status_reactivate")
     * @param int $id
     * @param InvestorRepository $investorRepository
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function reactivate(int $id,InvestorRepository $investorRepository,EntityManagerInterface $em)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","Investor profile cannot be found.");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $investor->setStatus(AvailableStatusMode::ACTIVE);

        $em->flush();

        $this->addFlash("light","Account has been reactivated.");

        return $this->redirectToRoute("admin_investor_profile_handle_settings",['id' => $id]);
    }

    /**
     * @Route("/admin/customer/investorprofile/ghost/{id}", name="admin_investor_edit_status_ghost")
     * @param int $id
     * @param InvestorRepository $investorRepository
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function ghost(int $id,InvestorRepository $investorRepository,EntityManagerInterface $em)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","Investor profile cannot be found.");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $investor->setStatus(AvailableStatusMode::GHOST);

        $em->flush();

        $this->addFlash("light","Account has been ghosted.");

        return $this->redirectToRoute("admin_investor_profile_handle_settings",['id' => $id]);
    }
}