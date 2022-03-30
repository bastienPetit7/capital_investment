<?php

namespace App\Controller\Admin\Widget;

use App\Entity\Widget;
use App\Entity\WidgetCode;
use App\Entity\WidgetContentLine;
use App\Entity\WidgetLine;
use App\Entity\WidgetTheme;
use App\Form\WidgetCodeType;
use App\Form\WidgetLineContentType;
use App\Form\WidgetLineType;
use App\Form\WidgetThemeType;
use App\Form\WidgetType;
use App\Repository\WidgetCodeRepository;
use App\Repository\WidgetContentLineRepository;
use App\Repository\WidgetLineRepository;
use App\Repository\WidgetRepository;
use App\Repository\WidgetThemeRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WidgetConfigurationController extends AbstractController
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

    #[Route('/admin/widget/theme/list', name: 'admin_widget_wallet_theme_list', methods: ['GET'])]
    public function listTheme(WidgetThemeRepository $widgetThemeRepository)
    {
        $widgetThemes = $widgetThemeRepository->findAll();

        return $this->render("admin/wallet_widget/widget_theme/list.html.twig",[
            "widgetThemes" => $widgetThemes
        ]);
    }

    #[Route('/admin/widget/wallet/create', name: 'admin_widget_wallet_theme_create')]
    public function createTheme(EntityManagerInterface $em, Request $request,ImageService $imageService)
    {
        $widgetTheme = new WidgetTheme();

        $form = $this->createForm(WidgetThemeType::class,$widgetTheme);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $imageService->saveImage($file,$widgetTheme);
            }
            else
            {
                $this->addFlash("danger","You must add an image.");
                return $this->redirectToRoute("admin_widget_theme_create");
            }

            $em->persist($widgetTheme);

            $em->flush();

            $this->addFlash("light","The wallet " . $widgetTheme->getName() . " has been created successfully.");

            return $this->redirectToRoute("admin_widget_wallet_theme_list");
        }

        return $this->render("admin/wallet_widget/widget_theme/create.html.twig",[
            "form" => $form->createView()
        ]);
    }

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
            'formCode' => $formCode->createView()
        ]);
    }

    #[Route('/admin/widget/create', name: 'admin_widget_create')]
    public function createWidget(Request $request,EntityManagerInterface $em)
    {
        $widget = new Widget();

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