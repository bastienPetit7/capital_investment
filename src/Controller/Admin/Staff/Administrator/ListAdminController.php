<?php

namespace App\Controller\Admin\Staff\Administrator;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListAdminController extends AbstractController
{
    /**
     * @Route("/admin/staff/administrator/list", name="admin_staff_administrator_list")
     */
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $admins = [];

        foreach ($users as $user)
        {
            if(in_array("ROLE_ADMIN", $user->getRoles()))
            {
                $admins[] = $user;
            }
        }

        return $this->render("admin/staff/administrator/list.html.twig",[
            'admins' => $admins
        ]);
    }
}