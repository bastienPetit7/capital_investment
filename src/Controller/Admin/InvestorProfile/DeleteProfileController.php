<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProfileController extends AbstractController
{
    /**
     * @Route("/admin/customer/investorprofile/delete/{id}", name="admin_investor_delete_account")
     * @param int $id
     * @param InvestorRepository $investorRepository
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(int $id,InvestorRepository $investorRepository,Request $request,EntityManagerInterface $em)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $user = $investor->getUser();

        $em->remove($user);

        $em->flush();

        $this->addFlash("success","The account has been deleted.");

        return $this->redirectToRoute("admin_investor_profile_list");
    }
}