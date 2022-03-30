<?php

namespace App\Controller\Admin\Widget;

use App\Entity\Widget;
use App\Entity\WidgetContentLine;
use App\Entity\WidgetLine;
use App\Form\WidgetLineContentType;
use App\Form\WidgetLineType;
use App\Form\WidgetType;
use App\Repository\WidgetRepository;
use App\Repository\WidgetThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WidgetConfigurationController extends AbstractController
{

    #[Route('/admin/widget/list', name: 'admin_widget_list', methods: ['GET'])]
    public function listWidget(WidgetRepository $widgetRepository)
    {
        $widgets = $widgetRepository->findAll();

        return $this->render("admin/wallet_widget/widget/list.html.twig",[
            "widgets" => $widgets
        ]);
    }

    #[Route('/admin/widget/set/{id}', name: 'admin_widget_set')]
    public function setWidget($id,WidgetRepository $widgetRepository,Request $request,EntityManagerInterface $em)
    {
        $widget = $widgetRepository->find($id);

        if(!$widget)
        {
            $this->addFlash("light","The widget could not be found.");

            return $this->redirectToRoute("admin_widget_list");
        }

        //HANDLE FORM WIDGET
        $formWidget = $this->createForm(WidgetType::class,$widget);
        $formWidget->handleRequest($request);
        if($formWidget->isSubmitted() && $formWidget->isValid())
        {
            $em->flush();

            $this->addFlash("light","The widget has been updated successfully.");

            return $this->redirectToRoute("admin_widget_set",['id' => $id]);
        }

        //HANDLE FORM LINE
        $widgetLine = new WidgetLine();
        $formLine = $this->createForm(WidgetLineType::class,$widgetLine);
        $formLine->handleRequest($request);
        if($formLine->isSubmitted() && $formLine->isValid())
        {
            $em->persist($widgetLine);

            $widgetLine->setWidget($widget);

            $em->flush();

            $this->addFlash("light","The line " . $widgetLine->getName() . " has been created successfully.");

            return $this->redirectToRoute("admin_widget_set",['id' => $id]);
        }

        //HANDLE FORM CODE
        $contentLine = new WidgetContentLine();
        $formCode = $this->createForm(WidgetLineContentType::class,[
            'lines' => $widget->getWidgetLines()
        ]);
        $formCode->handleRequest($request);
        if($formCode->isSubmitted() && $formCode->isValid())
        {
            $code = $formCode->get('code')->getData();
            $line = $formCode->get('line')->getData();
            $lineName = $line->getName();

            $contentLine->setWidgetCode($code);
            $contentLine->setWidgetLine($line);

            $em->persist($contentLine);
            $em->flush();

            $this->addFlash("light","A new code has been added to line $lineName");

            return $this->redirectToRoute("admin_widget_set",['id' => $id]);
        }


        return $this->render("admin/wallet_widget/widget/set.html.twig",[
            "widget" => $widget,
            'formLine' => $formLine->createView(),
            'formCode' => $formCode->createView(),
            'formWidget' => $formWidget->createView()
        ]);
    }

    #[Route('/admin/widget/create/{id?null}', name: 'admin_widget_create')]
    public function createWidget($id,Request $request,EntityManagerInterface $em,WidgetThemeRepository $widgetThemeRepository)
    {
        $widget = new Widget();

        if($id !== 'null')
        {
            $widgetTheme = $widgetThemeRepository->find($id);

            if($widgetTheme)
            {
                $widget->setWidgetTheme($widgetTheme);
            }
        }

        $form = $this->createForm(WidgetType::class,$widget);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($widget);

            $em->flush();

            $this->addFlash("light","Widget add with success");

            return $this->redirectToRoute("admin_widget_list");
        }

        return $this->render("admin/wallet_widget/widget/create.html.twig",[
            "form" => $form->createView()
        ]);
    }

    #[Route('/admin/widget/edit/status/{id}', name: 'admin_widget_edit_status')]
    public function editStatus($id,WidgetRepository $widgetRepository,EntityManagerInterface $em)
    {
        $widget = $widgetRepository->find($id);

        if(!$widget)
        {
            $this->addFlash("light","The widget could not be found.");

            return $this->redirectToRoute("admin_widget_list");
        }


        if($widget->getIsPublished() === true)
        {
            $widget->setIsPublished(0);
        }
        else
        {
            $widget->setIsPublished(1);
        }

        $em->flush();

        $this->addFlash("light","Status has been updated");

        return $this->redirectToRoute("admin_widget_set",['id' => $id]);
    }

    #[Route('/admin/widget/delete/{id}', name: 'admin_widget_delete')]
    public function remove($id,WidgetRepository $widgetRepository,EntityManagerInterface $em)
    {
        $widget = $widgetRepository->find($id);

        if(!$widget)
        {
            $this->addFlash("light","The widget could not be found.");

            return $this->redirectToRoute("admin_widget_list");
        }

        $em->remove($widget);

        $em->flush();

        $this->addFlash("light","Widget has been removed");

        return $this->redirectToRoute("admin_widget_list");
    }

}