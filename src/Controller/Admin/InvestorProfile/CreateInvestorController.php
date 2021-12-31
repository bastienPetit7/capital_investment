<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Entity\Investor;
use App\Entity\ListDocument;
use App\Entity\User;
use App\Entity\Wallet;
use App\Form\InvestorProfileFormType;
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
                            EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(InvestorProfileFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();

            $email = $form->get('email')->getData();

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

            $investor->setUser($user);

            $listDocument = new ListDocument();

            $investor->setListDocument($listDocument);

            $wallet = new Wallet();

            $initialAmount = $form->get('walletInitialAmount')->getData();

            $wallet->setInitialAmount($initialAmount);

            $wallet->setActualAmount($initialAmount);

            $investor->setWallet($wallet);

            $entityManager->persist($investor);
            $entityManager->persist($wallet);
            $entityManager->persist($listDocument);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("light","An investor has been created");

            return $this->redirectToRoute("admin_customer_investor_profile_list");

        }

        return $this->render('admin/investor_profile/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}