<?php

namespace App\Controller\Investor;

use App\Entity\Investor;
use App\Entity\User;
use App\Form\EditAccountPasswordType;
use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InvestorAccountController extends AbstractController
{
    #[Route('/investor/account', name: 'investor_account')]
    public function index(EntityManagerInterface $em,Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $formPassword = $this->createForm(EditAccountPasswordType::class);

        $formPassword->handleRequest($request);

        if($formPassword->isSubmitted() && $formPassword->isValid())
        {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $formPassword->get('plainPassword')->getData()
                )
            );

            $em->flush();

            $this->addFlash("info","Your password has been updated.");

            return $this->redirectToRoute("investor_account");

        }

        return $this->render('dashboard/investor/investor_account/index.html.twig', [
            'user' => $user,
            'formPassword' => $formPassword->createView()
        ]);
    }

    #[Route('/investor/account/update/{id}', name: 'update_investor_account')]
    public function updateAccount(): Response
    {
        return $this->render('dashboard/investor/investor_account/update.html.twig');
    }
}
