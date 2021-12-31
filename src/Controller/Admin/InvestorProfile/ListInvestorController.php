<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListInvestorController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/list", name="admin_investor_profile_list")
     */
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $investors = [];

        foreach ($users as $user)
        {
            if(in_array("ROLE_INVESTOR", $user->getRoles()))
            {
                $investors[] = $user;
            }
        }

        return $this->render("admin/investor_profile/list.html.twig",[
            'investors' => $investors
        ]);
    }
}