<?php

namespace App\Controller\Admin\InvestorProfile;

use DateTime;
use App\Entity\Investor;
use App\Entity\ReportingDetails;
use App\Form\ReportingDetailsType;
use App\Form\ReportingDetailsEditType;
use App\Repository\InvestorRepository;
use App\Repository\ReportingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReportingDetailsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ReportingDetailsController extends AbstractController
{
   

    #[Route('/admin/investorprofile/{id}/handlereportingdetail/new', name: 'admin_investor_profile_handle_reporting_detail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Investor $investor, ReportingRepository $reportingRepository): Response
    {
        $reportingDetail = new ReportingDetails();
        $form = $this->createForm(ReportingDetailsType::class, $reportingDetail);
        $form->handleRequest($request);

        $reporting = $reportingRepository->findOneBy(['investorId' => $investor->getId()]); 



        if ($form->isSubmitted() && $form->isValid()) {

            $datas = $form->getData(); 
            $month = $form->get('month')->getData(); 
            $year = $form->get('year')->getData(); 

            $date = new DateTime($month.''.$year); 

            $reportingDetail->setDate($date); 
            $reportingDetail->setReporting($reporting); 

            

            $entityManager->persist($reportingDetail);   
            $entityManager->flush();

            return $this->redirectToRoute('admin_investor_profile_handle_reporting', ['id' => $investor->getId() ], Response::HTTP_SEE_OTHER);
        }



        return $this->renderForm('admin/investor_profile/reporting_details/new.html.twig', [
            'reporting_detail' => $reportingDetail,
            'form' => $form,
            'investor' => $investor
        ]);
    }









    #[Route('/admin/investorprofile/{id}/handlereportingdetail/{repoDetailId}/edit', name: 'admin_investor_profile_handle_reporting_detail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, int $repoDetailId, ReportingDetailsRepository $reportingDetailsRepository, EntityManagerInterface $entityManager, InvestorRepository $investorRepository): Response
    {
        $investor = $investorRepository->find($id); 

        $reportingDetail = $reportingDetailsRepository->find($repoDetailId); 
        $explodedDate = explode('-', $reportingDetail->getDate()->format('Y-F')) ; 
        $year = $explodedDate[0];
        $month = $explodedDate[1];

        

        $form = $this->createForm(ReportingDetailsEditType::class, $reportingDetail, ['month' => $month, 'year' => $year]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $month = $form->get('month')->getData(); 
            $year = $form->get('year')->getData(); 

            $date = new DateTime($month.''.$year); 

            $reportingDetail->setDate($date); 


            $entityManager->flush();

            return $this->redirectToRoute('admin_investor_profile_handle_reporting', [
                'id' => $id
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/investor_profile/reporting_details/edit.html.twig', [
            'reporting_detail' => $reportingDetail,
            'form' => $form,
            'investor' => $investor
        ]);
    }








    #[Route('/admin/investorprofile/{id}/handlereportingdetail/delete/{repoDetailId}', name: 'reporting_details_delete', methods: ['POST'])]
    public function delete(Request $request, int $id, int $repoDetailId, ReportingDetailsRepository $reportingDetailsRepository, InvestorRepository $investorRepository,  EntityManagerInterface $entityManager): Response
    {
        $reportingDetail = $reportingDetailsRepository->find($repoDetailId); 
    

        if ($this->isCsrfTokenValid('delete'.$reportingDetail->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reportingDetail);
            $entityManager->flush();
        }

        

        return $this->redirectToRoute('admin_investor_profile_handle_reporting', ['id' => $id ],  Response::HTTP_SEE_OTHER);
    }


}
