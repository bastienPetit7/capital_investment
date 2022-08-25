<?php

namespace App\Controller\Investor\Position;

use App\Repository\PositionRepository;
use DateTime;
use Knp\Snappy\Pdf;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class InvestorPositionController extends AbstractController
{


    #[Route('investor/position/all/{export?null}', name: 'investor_position', methods: ['GET'])]
    public function positionAll($export,PositionRepository $positionRepository): Response
    {

        $positions = $positionRepository->findBy([],[
            'publishedAt' => 'DESC'
        ]);

        if($export === 'csv')
        {
            return $this->getCSV($positions);
        }

        $totalPips = 0;
        $nombreDePositions = 0;

        foreach ($positions as $position)
        {
            if($position->getPips())
            {
                $totalPips += $position->getPips();
            }

            if($position->getPositionState())
            {
                $nombreDePositions += 1;
            }
        }

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'totalPips' => $totalPips,
            'nombreDePositions' => $nombreDePositions,
            'date' => 'All',
            'pathRoute' => 'investor_position'
        ]);
    }

    #[Route('investor/position/week/{export?null}', name: 'investor_position_week', methods: ['GET'])]
    public function positionOfTheWeek($export,PositionRepository $positionRepository): Response
    {

        $date = new DateTime();

        $positions = $positionRepository->findBy([
            'weekOfCreation' => $date->format("W")
        ],[
            'publishedAt' => 'DESC'
        ]);

        if($export === 'csv')
        {
            return $this->getCSV($positions);
        }

        $totalPips = 0;
        $nombreDePositions = 0;

        foreach ($positions as $position)
        {
            if($position->getPips())
            {
                $totalPips += $position->getPips();
            }

            if($position->getPositionState())
            {
                $nombreDePositions += 1;
            }
        }

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'date' => 'Week ' . $date->format("W"),
            'pathRoute' => 'investor_position_week',
            'totalPips' => $totalPips,
            'nombreDePositions' => $nombreDePositions
        ]);
    }

    #[Route('investor/position/day/{export?null}', name: 'investor_position_day', methods: ['GET'])]
    public function positionOfTheDay($export,PositionRepository $positionRepository): Response
    {

        $date = new DateTime();

        $positions = $positionRepository->findBy([
            'publishedAt' => $date
        ],[
            'publishedAt' => 'DESC'
        ]);

        if($export === 'csv')
        {
            return $this->getCSV($positions);
        }


        $totalPips = 0;
        $nombreDePositions = 0;

        foreach ($positions as $position)
        {
            if($position->getPips())
            {
                $totalPips += $position->getPips();
            }

            if($position->getPositionState())
            {
                $nombreDePositions += 1;
            }
        }

        return $this->render('dashboard/investor/position/live_trading.html.twig', [
            'positions' => $positions,
            'date' => $date->format('d-M-Y'),
            'pathRoute' => 'investor_position_day',
            'totalPips' => $totalPips,
            'nombreDePositions' => $nombreDePositions
        ]);
    }

    #[Route('investor/position/pdf/all/', name: 'investor_position_pdf_all', methods: ['GET'])]
    public function generatePDF(PositionRepository $positionRepository,Environment $twig)
    {
        $positions = $positionRepository->findBy([],[
            'publishedAt' => 'DESC'
        ]);

        $html = $twig->render("pdf/positions.html.twig",[
            'positions' => $positions
        ]);

        $pdfPath = '/tmp/' . uniqid() . '-invoice_creation.pdf';

        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');

        $snappy->generateFromHtml($html, $pdfPath);

        if (!file_exists($pdfPath)) {
            $this->addFlash("info","Problème dans la génération du PDF.");
            return $this->redirectToRoute("investor_position_pdf_all");
        }

        $response =  new BinaryFileResponse($pdfPath);

        $filename = "positions_all.pdf";

        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));

        return $response;
    }

    private function getCSV($positions)
    {
        $separator = ',';

        $dataToSendCSV = "date,action,left,right,type,price,tp1,tp2,tp3,tp4,sl,result,pips  \n";

        foreach ($positions as $item)
        {
            $dataToSendCSV .= $item->getPublishedAt()->format('Y-m-d') . $separator .
                $item->getAction() . $separator .
                $item->getActiveLeft() . $separator .
                $item->getActiveRight() . $separator .
                $item->getType() . $separator .
                $item->getPrice() . $separator .
                $item->getTp1() . $separator .
                $item->getTp2() . $separator .
                $item->getTp3() . $separator .
                $item->getTp4() . $separator .
                $item->getStopLoss() . $separator .
                $item->getPositionState() . $separator .
                $item->getPips() . "\n";
        }

        $fileSystem = new Filesystem();

        $fileSystem->remove($this->getParameter('app_temp_directory'));

        $tempFile = $fileSystem->tempnam($this->getParameter('app_temp_directory'), 'datedemand');

        $fileSystem->dumpFile($tempFile, $dataToSendCSV);

        $response =  new BinaryFileResponse($tempFile);

        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', 'data_all_position.csv'));

        return $response;
    }
}