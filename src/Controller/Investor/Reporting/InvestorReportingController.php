<?php

namespace App\Controller\Investor\Reporting;

use App\Entity\User;
use App\Repository\InvestorRepository;
use App\Repository\ReportingDetailsRepository;
use App\Repository\ReportingRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvestorReportingController extends AbstractController
{

    #[Route('investor/reporting', name: 'investor_reporting', methods: ['GET'] )]
    public function index(
        ReportingRepository $reportingRepository,
        ReportingDetailsRepository $reportingDetailsRepository,
        UserRepository $userRepository,
        InvestorRepository $investorRepository)
    {
        $user = $this->getUser();

        $user = $userRepository->findOneBy(['email' => $user->getUserIdentifier()]);

        // dd($user); 
        
        $investor = $investorRepository->findOneBy(['user' => $user->getId()] ); 
        
        

        $reporting = $reportingRepository->findOneBy(['investorId' => $investor->getId()]);

        
        $reportings = $reportingDetailsRepository->findBy([ 'reporting' => $reporting->getId()], ['date' => 'desc']);
        

        return $this->render('dashboard/investor/reporting/index.html.twig', [
            'reportings' => $reportings,
            'investor' => $user

        ]);
    }


}