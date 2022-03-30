<?php

namespace App\Controller\Admin\Widget;

use App\Entity\Widget;
use App\Entity\WidgetCode;
use App\Entity\WidgetLine;
use App\Entity\WidgetTheme;
use App\Form\WidgetCodeType;
use App\Form\WidgetLineType;
use App\Form\WidgetThemeType;
use App\Form\WidgetType;
use App\Repository\WidgetCodeRepository;
use App\Repository\WidgetRepository;
use App\Repository\WidgetThemeRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

        $widgetLine = new WidgetLine();

        $formLine = $this->createForm(WidgetLineType::class,$widgetLine);

        $formLine->handleRequest($request);

        if($formLine->isSubmitted() && $formLine->isValid())
        {
            $em->persist($widgetLine);

            $em->flush();

            $this->addFlash("light","The line " . $widgetLine->getName() . " has been created successfully.");

            return $this->redirectToRoute("admin_widget_set",['id' => $id]);
        }

        return $this->render("admin/wallet_widget/widget/set.html.twig",[
            "widget" => $widget,
            'formLine' => $formLine->createView()
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
}