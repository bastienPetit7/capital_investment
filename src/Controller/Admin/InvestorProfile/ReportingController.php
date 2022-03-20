<?php

namespace App\Controller\Admin\InvestorProfile;

use App\Entity\Investor;
use App\Entity\Reporting;
use App\Form\ReportingInvestorType;
use App\Repository\ReportingDetailsRepository;
use App\Repository\ReportingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReportingController extends AbstractController
{

    #[Route('/admin/investorprofile/{id}/handlereporting', name: 'admin_investor_profile_handle_reporting', methods: ['GET'])]
    public function show(
        Request $request, 
        Investor $investor,
        ReportingRepository $reportingRepository,
        ReportingDetailsRepository $reportingDetailsRepository): Response
    {
        $reporting = $reportingRepository->findOneBy(['investorId' => $investor->getId()]); 

        $reportingDetails = $reportingDetailsRepository->findBy(['reporting' => $reporting->getId()], ['date' => 'desc']);

        
       

        return $this->render('admin/investor_profile/reporting/index.html.twig', [
            'reporting' => $reporting, 
            'investor' => $investor,
            'reportings' => $reportingDetails
        ]);
    }


    #[Route('/admin/investorprofile/{id}/handlereporting/new', name: 'admin_investor_profile_create_reporting', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Investor $investor): Response
    {
        $reporting = new Reporting();
        
        $reporting->setInvestorId($investor); 
        $reporting->setReportingName($investor->getUser()->getName().'_reporting'); 
         

        $entityManager->persist($reporting);
        $entityManager->flush();

        return $this->redirectToRoute('admin_investor_profile_handle_reporting', [
            'id' => $investor->getId()
        ], Response::HTTP_SEE_OTHER);
        

       
    }

   
    #[Route('/admin/investorprofile/{id}/handlereporting/edit', name: 'admin_investor_profile_edit_reporting', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reporting $reporting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReportingType::class, $reporting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reporting_template_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reporting_template/edit.html.twig', [
            'reporting' => $reporting,
            'form' => $form,
        ]);
    }

    #[Route('/admin/investorprofile/{id}/handlereporting/delete', name: 'admin_investor_profile_delete_reporting', methods: ['POST'])]
    public function delete(Request $request, Reporting $reporting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reporting->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reporting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reporting_template_index', [], Response::HTTP_SEE_OTHER);
    }
}