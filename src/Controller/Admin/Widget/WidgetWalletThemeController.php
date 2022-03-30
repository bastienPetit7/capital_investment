<?php

namespace App\Controller\Admin\Widget;

use App\Entity\WidgetTheme;
use App\Form\WidgetThemeType;
use App\Repository\WidgetThemeRepository;
use App\Services\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WidgetWalletThemeController extends AbstractController
{
    #[Route('/admin/widget/wallet/theme/list', name: 'admin_widget_wallet_theme_list', methods: ['GET'])]
    public function listTheme(WidgetThemeRepository $widgetThemeRepository)
    {
        $widgetThemes = $widgetThemeRepository->findAll();

        return $this->render("admin/wallet_widget/widget_theme/list.html.twig",[
            "widgetThemes" => $widgetThemes
        ]);
    }

    #[Route('/admin/widget/wallet/theme/create', name: 'admin_widget_wallet_theme_create')]
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

    #[Route('/admin/widget/wallet/theme/edit/{id}', name: 'admin_widget_wallet_theme_edit')]
    public function editTheme($id,WidgetThemeRepository $widgetThemeRepository,EntityManagerInterface $em, Request $request,ImageService $imageService)
    {
        $widgetTheme = $widgetThemeRepository->find($id);

        if(!$widgetTheme)
        {
            $this->addFlash("danger","This wallet widget is not found");
            return $this->redirectToRoute("admin_widget_wallet_theme_list");
        }

        $oldImage = $widgetTheme->getImagePath();

        $form = $this->createForm(WidgetThemeType::class,$widgetTheme);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $imageService->editImage($oldImage,$file,$widgetTheme);
            }

            $em->flush();

            $this->addFlash("light","The wallet " . $widgetTheme->getName() . " has been edited successfully.");

            return $this->redirectToRoute("admin_widget_wallet_theme_edit",['id' => $id]);
        }

        return $this->render("admin/wallet_widget/widget_theme/edit.html.twig",[
            "form" => $form->createView(),
            'widgetTheme' => $widgetTheme
        ]);
    }


}