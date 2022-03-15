<?php

namespace App\Controller\Investor;

use App\Entity\Investor;
use App\Repository\InvestorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvestorAccountController extends AbstractController
{
    #[Route('/investor/account', name: 'investor_account')]
    public function index(InvestorRepository $investorRepository): Response
    {

        $investor = $this->getUser();
        // $investor = $investorRepository->find($id);
        // dd($investor); 

        return $this->render('dashboard/investor/investor_account/index.html.twig', [
            'investor' => $investor
        ]);
    }

    #[Route('/investor/account/update/{id}', name: 'update_investor_account')]
    public function updateAccount(): Response
    {
        return $this->render('dashboard/investor/investor_account/update.html.twig');
    }
}
