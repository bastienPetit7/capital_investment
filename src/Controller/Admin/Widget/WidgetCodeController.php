<?php

namespace App\Controller\Admin\Widget;

use App\Entity\WidgetCode;
use App\Form\WidgetCodeType;
use App\Repository\WidgetCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WidgetCodeController extends AbstractController
{
    #[Route('/admin/widget/code/list', name: 'admin_widget_code_list', methods: ['GET'])]
    public function listCode(WidgetCodeRepository $widgetCodeRepository,PaginatorInterface $paginator, Request $request)
    {

        $widgetCodes = $paginator->paginate(
            $widgetCodeRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render("admin/wallet_widget/widget_code/list.html.twig",[
            "widgetCodes" => $widgetCodes
        ]);
    }

    #[Route('/admin/widget/code/create', name: 'admin_widget_code_create')]
    public function createCode(Request $request,EntityManagerInterface $em)
    {
        $widgetCode = new WidgetCode();

        $form = $this->createForm(WidgetCodeType::class,$widgetCode);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($widgetCode);

            $em->flush();

            $this->addFlash("light","Code add with success");

            return $this->redirectToRoute("admin_widget_code_list");
        }

        return $this->render("admin/wallet_widget/widget_code/create.html.twig",[
            "form" => $form->createView()
        ]);
    }


    #[Route('/admin/widget/code/edit/{id}', name: 'admin_widget_code_edit')]
    public function edit($id,WidgetCodeRepository $widgetCodeRepository ,Request $request,EntityManagerInterface $em)
    {
        $widgetCode = $widgetCodeRepository->find($id);

        if(!$widgetCode)
        {
            $this->addFlash("danger","Code cannot be found");
            return $this->redirectToRoute("admin_widget_code_list");
        }

        $form = $this->createForm(WidgetCodeType::class,$widgetCode);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            $this->addFlash("light","Code edited with success");

            return $this->redirectToRoute("admin_widget_code_list");
        }

        return $this->render("admin/wallet_widget/widget_code/edit.html.twig",[
            "form" => $form->createView(),
            'widgetCode' => $widgetCode
        ]);
    }

    #[Route('/admin/widget/code/delete/{id}', name: 'admin_widget_code_delete')]
    public function delete($id,WidgetCodeRepository $widgetCodeRepository ,EntityManagerInterface $em)
    {
        $widgetCode = $widgetCodeRepository->find($id);

        if(!$widgetCode)
        {
            $this->addFlash("danger","Code cannot be found");
            return $this->redirectToRoute("admin_widget_code_list");
        }

        $em->remove($widgetCode);

        $em->flush();

        $this->addFlash("light","Code removed with success");

        return $this->redirectToRoute("admin_widget_code_list");




    }
}