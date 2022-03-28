<?php

namespace App\Controller\Admin\Staff\Administrator;

use App\Entity\User;
use App\Form\StaffType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateAdminController extends AbstractController
{
    /**
     * @Route("/admin/staff/administrator/create", name="admin_staff_administrator_create")
     */
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                           EntityManagerInterface $em)
    {
        $form = $this->createForm(StaffType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();

            $email = $form->get('email')->getData();

            $user->setEmail($email);

            $name = $form->get('name')->getData();

            $user->setName($name);

            $phone = $form->get('telephone')->getData();

            $user->setTelephone($phone);

            $role = $form->get('role')->getData();

            if($role === 'Manager')
            {
                $user->setRoles(["ROLE_MANAGER"]);
            }

            if($role === 'Administrator')
            {
                $user->setRoles(["ROLE_ADMIN"]);
            }

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    'capital1234'
                )
            );

            $em->persist($user);

            $em->flush();

            $this->addFlash("light","The $role has been created");

            return $this->redirectToRoute("admin_staff_administrator_list");
        }



        return $this->render("admin/staff/administrator/create.html.twig",[
            'form' => $form->createView(),
        ]);
    }
}