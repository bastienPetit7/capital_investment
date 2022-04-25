<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Entity\Investor;
use App\Entity\ListDocument;
use App\Entity\Reporting;
use App\Entity\User;
use App\Entity\Wallet;
use App\Form\InvestorProfileFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateInvestorController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/create", name="admin_investor_profile_create")
     */
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                            EntityManagerInterface $entityManager,UserRepository $userRepository)
    {

        $form = $this->createForm(InvestorProfileFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();

            $email = $form->get('email')->getData();

            $isUserExist = $userRepository->findOneBy([
               'email' => $email
            ]);

            if($isUserExist)
            {
                $this->addFlash("danger","An investor already exist with this email : $email.");

                return $this->redirectToRoute("admin_investor_profile_create");
            }

            $user->setEmail($email);

            $name = $form->get('name')->getData();

            $user->setName($name);

            $phone = $form->get('telephone')->getData();

            $user->setTelephone($phone);

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    'capital1234'
                )
            );

            $user->setRoles(["ROLE_INVESTOR"]);

            $investor = new Investor();

            $createdAt = $form->get('createdAt')->getData();

            $investor->setCreatedAt($createdAt);

            $investor->setUser($user);

            $listDocument = new ListDocument();

            $investor->setListDocument($listDocument);
            

            $entityManager->persist($investor);
            $entityManager->persist($listDocument);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("light","An investor has been created");

            return $this->redirectToRoute("admin_investor_profile_list");

        }

        return $this->render('admin/investor_profile/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}