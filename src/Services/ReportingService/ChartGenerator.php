<?php


namespace App\Services\ReportingService;


use App\Dictionary\Movement;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use App\Repository\ReportingMovementRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartGenerator
{

    /**
     * @var ChartBuilderInterface
     */
    protected $chartBuilder;
    private ReportingMovementRepository $reportingMovementRepository;

    public function __construct(ChartBuilderInterface $chartBuilder,ReportingMovementRepository $reportingMovementRepository)
    {
        $this->chartBuilder = $chartBuilder;
        $this->reportingMovementRepository = $reportingMovementRepository;
    }

    public function getDateForChart($movements,$dateDepositInitial)
    {
        $labels = [$dateDepositInitial->format('M-d-Y')];

        foreach ($movements as $movement)
        {
            $labels[] = $movement->getCreatedAt()->format('M-d-Y');
        }

        return $labels;
    }

    public function getValueForChart($movements,$depositInitial)
    {
        $depositInitial = $depositInitial / 100;

        $data = [$depositInitial];

        /** @var ReportingMovement $movement */
        foreach ($movements as $movement)
        {
            if($movement->getName() === Movement::DEPOSIT)
            {
                $value = end($data);
                $data[] = round(($value + ($movement->getCashIn()->getAmount() / 100)), 2);

            }elseif ($movement->getName() === Movement::WITHDRAWAL)
            {
                $value = end($data);
                $data[] = round(($value + ($movement->getCashOut()->getAmount() / 100)), 2);

            }elseif ($movement->getName() === Movement::EARNING)
            {
                $value = end($data);
                $data[] = round(($value - ($movement->getInterestEarn()->getAmount() / 100)), 2);

            }
        }

        return $data;
    }

    public function getChartLine($movements,Wallet $wallet)
    {
        $depositInitial = $wallet->getInitialAmount();
        $dateDepositInitial = $wallet->getInvestor()->getCreatedAt();

        $labels = $this->getDateForChart($movements,$dateDepositInitial);
        $data = $this->getValueForChart($movements,$depositInitial);


        //Set up the graph
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Reporting',
                    'backgroundColor' => 'rgb(62, 182, 160)',
                    'borderColor' => 'rgb(37, 106, 154)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $chart;
    }

    private function getValueForChartBar($reporting,$labels,$year)
    {
        $data = [];

        foreach ($labels as $month)
        {
            $resultMonthly = $this->reportingMovementRepository->findMovementPerMonthAndYearAndReporting($reporting,$month,$year);

            if($resultMonthly)
            {
                $valueInEuro = $resultMonthly->getWalletAmountAfterMovement() / 100;
                $data[] = $valueInEuro;
            }
            else
            {
                $data[] = 0;
            }


        }

        return $data;
    }

    public function getChartBar(Wallet $wallet,$year)
    {
        $reporting = $wallet->getReporting();

        $labels = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $data = $this->getValueForChartBar($reporting,$labels,$year);


        //Set up the graph
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Capital Evolution',
                    'backgroundColor' => 'rgb(62, 182, 160)',
                    'borderColor' => 'rgb(37, 106, 154)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $chart;
    }

}