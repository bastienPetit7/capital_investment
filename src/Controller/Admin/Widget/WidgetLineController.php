<?php

namespace App\Controller\Admin\Widget;

use App\Repository\WidgetContentLineRepository;
use App\Repository\WidgetLineRepository;
use App\Repository\WidgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WidgetLineController extends AbstractController
{
    #[Route('/admin/widget/delete/contentLine/{id}/{idWidget}', name: 'admin_widget_delete_content_line')]
    public function deleteContentWidget($id,$idWidget,WidgetRepository $widgetRepository,WidgetContentLineRepository $widgetContentLineRepository,EntityManagerInterface $em)
    {
        $widget = $widgetRepository->find($idWidget);

        if(!$widget)
        {
            $this->addFlash("danger","Widget not found");

            return $this->redirectToRoute("admin_widget_list");
        }

        $content = $widgetContentLineRepository->find($id);

        if(!$content)
        {
            $this->addFlash("danger","Content Code not found");

            return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
        }

        $em->remove($content);

        $em->flush();

        $this->addFlash("light","Content Code has been deleted");

        return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);

    }

    #[Route('/admin/widget/edit/line/{id}/{idWidget}', name: 'admin_widget_edit_line')]
    public function editLine($id,$idWidget,WidgetRepository $widgetRepository,WidgetLineRepository $widgetLineRepository,EntityManagerInterface $em,Request $request)
    {
        $widget = $widgetRepository->find($idWidget);

        if(!$widget)
        {
            $this->addFlash("danger","Widget not found");

            return $this->redirectToRoute("admin_widget_list");
        }

        $line = $widgetLineRepository->find($id);

        if(!$line)
        {
            $this->addFlash("danger","Line not found");

            return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
        }

        $data = $request->request;

        $form = $data->get("widget_line_$id");

        if(!$form)
        {
            $this->addFlash("danger","Form not found");

            return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
        }

        $name = $form['name'];

        $line->setName($name);

        $em->flush();

        $this->addFlash("light","Line has been updated");

        return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
    }

    #[Route('/admin/widget/delete/line/{id}/{idWidget}', name: 'admin_widget_delete_line')]
    public function deleteLine($id,$idWidget,WidgetRepository $widgetRepository,WidgetLineRepository $widgetLineRepository,EntityManagerInterface $em,Request $request)
    {
        $widget = $widgetRepository->find($idWidget);

        if(!$widget)
        {
            $this->addFlash("danger","Widget not found");

            return $this->redirectToRoute("admin_widget_list");
        }

        $line = $widgetLineRepository->find($id);

        if(!$line)
        {
            $this->addFlash("danger","Line not found");

            return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
        }

        $em->remove($line);

        $em->flush();

        $this->addFlash("light","Line has been removed");

        return $this->redirectToRoute("admin_widget_set",['id' => $idWidget]);
    }
}