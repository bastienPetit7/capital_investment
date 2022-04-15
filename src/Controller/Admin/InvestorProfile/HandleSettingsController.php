<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Form\EditUserInformationType;
use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HandleSettingsController extends AbstractController
{
    /**
     * @Route("/admin/investorprofile/handlesettings/{id}", name="admin_investor_profile_handle_settings")
     */
    public function show(int $id,InvestorRepository $investorRepository,Request $request,EntityManagerInterface $em)
    {
        $investor = $investorRepository->find($id);

        if(!$investor)
        {
            $this->addFlash("danger","This investor profile cannot be found");
            return $this->redirectToRoute("admin_investor_profile_list");
        }

        $user = $investor->getUser();

        $email = $user->getEmail();

        $name = $user->getName();

        $telephone = $user->getTelephone();

        $createdAt = $investor->getCreatedAt();

        $form = $this->createForm(EditUserInformationType::class,[
            'email' => $email,
            'name' => $name,
            'telephone' => $telephone,
            'createdAt' => $createdAt
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $email = $form->get('email')->getData();
            $name = $form->get('name')->getData();
            $telephone = $form->get('telephone')->getData();
            $createdAt = $form->get('createdAt')->getData();

            $user->setEmail($email);
            $user->setName($name);
            $user->setTelephone($telephone);
            $investor->setCreatedAt($createdAt);

            $em->flush();

            $this->addFlash("success","Profile has been updated with success");

            return $this->redirectToRoute("admin_investor_profile_handle_settings",['id' => $id]);

        }

        return $this->render('admin/investor_profile/handle_settings.html.twig',[
            'investor' => $investor,
            'form' => $form->createView()
        ]);
    }
}