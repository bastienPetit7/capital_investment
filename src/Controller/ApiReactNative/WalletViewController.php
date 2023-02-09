<?php

namespace App\Controller\ApiReactNative;

use App\Repository\WidgetThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WalletViewController extends AbstractController
{
    /**
     * @Route("/walletview/crypto/app", name="api_wallet_crypto_view")
     */
    public function marketView(WidgetThemeRepository $widgetThemeRepository)
    {
        $widgetTheme = $widgetThemeRepository->find(1);

        $widgets = $widgetTheme->getWidgets();

        $widgetsAvailable = [];

        foreach($widgets as $item)
        {
            if($item->getIsPublished())
            {
                $widgetsAvailable[] = $item;
            }
        }

        return $this->render('dashboard/investor/wallet/app_view.html.twig',[
            "widgetsAvailable" => $widgetsAvailable,
        ]);
    }
}