<?php

namespace App\Controller\Admin\CapitalInvestmentAsset;

use App\Form\EditRecoveryFoundTotalType;
use App\Form\EditTotalAssetType;
use App\Repository\CapitalInvestmentAssetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowCapitalInvestmentAssetController extends AbstractController
{
    /**
     * @Route("/admin/capitalinvestmentasset/show", name="admin_capital_investment_asset")
     */
    public function show(CapitalInvestmentAssetRepository $capitalInvestmentAssetRepository,
                         EntityManagerInterface $em,Request $request)
    {
        $capitalInvestmentAsset = $capitalInvestmentAssetRepository->findOneBy([]);

        //FORM POUR HANDLE RECOVERY FOUND TOTAL
        $formRecoveryFound = $this->createForm(EditRecoveryFoundTotalType::class,[
            'recoveryfoundtotal' => $capitalInvestmentAsset->getRecoveryFoundTotal()
        ]);
        $formRecoveryFound->handleRequest($request);
        if($formRecoveryFound->isSubmitted() && $formRecoveryFound->isValid())
        {
            $recoveryfoundtotal = $formRecoveryFound->get('recoveryfoundtotal')->getData();

            $capitalInvestmentAsset->setRecoveryFoundTotal($recoveryfoundtotal);

            $em->flush();

            $this->addFlash("light","Recovery Found Total has been updated.");

            return $this->redirectToRoute("admin_capital_investment_asset");
        }

        //FORM POUR HANDLE TOTAL ASSET
        $formTotalAsset = $this->createForm(EditTotalAssetType::class,[
            'totalasset' => $capitalInvestmentAsset->getTotalAsset()
        ]);
        $formTotalAsset->handleRequest($request);
        if($formTotalAsset->isSubmitted() && $formTotalAsset->isValid())
        {
            $totalAsset = $formTotalAsset->get('totalasset')->getData();

            $capitalInvestmentAsset->setTotalAsset($totalAsset);

            $em->flush();

            $this->addFlash("light","Total Asset has been updated.");

            return $this->redirectToRoute("admin_capital_investment_asset");
        }

        return $this->render("admin/capital_investment_asset/show.html.twig",[
            'capitalInvestmentAsset' => $capitalInvestmentAsset,
            'formTotalAsset' => $formTotalAsset->createView(),
            'formRecoveryFound' => $formRecoveryFound->createView(),
        ]);
    }
}