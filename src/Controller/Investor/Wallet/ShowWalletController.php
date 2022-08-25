<?php

namespace App\Controller\Investor\Wallet;

use App\Entity\User;
use App\Repository\CapitalInvestmentAssetRepository;
use App\Repository\WidgetThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowWalletController extends AbstractController
{
    /**
     * @Route("/investor/wallet/list", name="investor_wallet_list")
     */
    public function index(WidgetThemeRepository $widgetThemeRepository): Response
    {
        return $this->render('dashboard/investor/wallet/list.html.twig',[
            "widgetThemes" => $widgetThemeRepository->findAll()
        ]);
    }

    /**
     * @Route("/investor/widget/list/{id}", name="investor_widget_list_per_wallet")
     */
    public function showAllWidget($id,WidgetThemeRepository $widgetThemeRepository)
    {
        $widgetTheme = $widgetThemeRepository->find($id);

        if(!$widgetTheme)
        {
            $this->addFlash("danger","Wallet cannot be found.");
            return $this->redirectToRoute('investor_wallet_list');
        }

        $widgets = $widgetTheme->getWidgets();

        $widgetsAvailable = [];

        foreach($widgets as $item)
        {
            if($item->getIsPublished())
            {
                $widgetsAvailable[] = $item;
            }
        }

        return $this->render('dashboard/investor/wallet/show.html.twig',[
            "widgetTheme" => $widgetTheme,
            "widgetsAvailable" => $widgetsAvailable,
        ]);

    }
}
