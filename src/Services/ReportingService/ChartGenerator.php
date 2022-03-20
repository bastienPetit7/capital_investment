<?php


namespace App\Services\ReportingService;


use App\Dictionary\Movement;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartGenerator
{

    /**
     * @var ChartBuilderInterface
     */
    protected $chartBuilder;

    public function __construct(ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
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

    public function getChart($movements,Wallet $wallet)
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
}