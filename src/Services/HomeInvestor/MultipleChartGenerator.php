<?php

namespace App\Services\HomeInvestor;

use App\Dictionary\Movement;
use App\Entity\ReportingMovement;
use App\Entity\Wallet;
use App\Repository\ReportingMovementRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class MultipleChartGenerator
{

    /**
     * @var ChartBuilderInterface
     */
    protected ChartBuilderInterface $chartBuilder;
    private ReportingMovementRepository $reportingMovementRepository;

    /**
     * @param ChartBuilderInterface $chartBuilder
     * @param ReportingMovementRepository $reportingMovementRepository
     */
    public function __construct(ChartBuilderInterface $chartBuilder, ReportingMovementRepository $reportingMovementRepository)
    {
        $this->chartBuilder = $chartBuilder;
        $this->reportingMovementRepository = $reportingMovementRepository;
    }

    private function getDateForChartLineEvolutionCapital($movements,$dateDepositInitial)
    {
        $dateDepositInitial = $dateDepositInitial->format('M-d-Y');

        $labels = [$dateDepositInitial];

        foreach ($movements as $movement)
        {
            $labels[] = $movement->getCreatedAt()->format('M-d-Y');
        }

        return $labels;
    }

    private function getValueForChartLineEvolutionCapital($movements,$depositInitial)
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
                $data[] = round(($value - ($movement->getCashOut()->getAmount() / 100)), 2);

            }elseif ($movement->getName() === Movement::EARNING)
            {
                $value = end($data);
                $data[] = round(($value + ($movement->getInterestEarn()->getAmount() / 100)), 2);

            }elseif ($movement->getName() === Movement::BONUS)
            {
                $value = end($data);
                $data[] = round(($value + ($movement->getBonus()->getAmount() / 100)), 2);

            }
        }
        return $data;
    }

    public function getChartLineEvolutionCapital($movements,Wallet $wallet)
    {
        $depositInitial = $wallet->getOriginInitialAmount();
        $dateDepositInitial = $wallet->getInvestor()->getCreatedAt();

        $labels = $this->getDateForChartLineEvolutionCapital($movements,$dateDepositInitial);
        $data = $this->getValueForChartLineEvolutionCapital($movements,$depositInitial);

        //Set up the graph
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Evolution Capital",
                    'backgroundColor' => 'rgb(37, 106, 154)',
                    'borderColor' => 'rgb(62, 182, 160)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $chart;
    }

    public function getChartLineEvolutionEarningInterest($movements)
    {

        $labels = $this->getDateForChartLineEvolutionInterest($movements);
        $data = $this->getValueForChartLineEvolutionInterest($movements);

        //Set up the graph
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Evolution Earning",
                    'backgroundColor' => 'rgb(37, 106, 154)',
                    'borderColor' => 'rgb(62, 182, 160)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $chart;
    }

    public function getChartLineEvolutionRateInterest($movements)
    {

        $labels = $this->getDateForChartLineEvolutionRateInterest($movements);
        $data = $this->getValueForChartLineEvolutionRateInterest($movements);

        //Set up the graph
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Evolution Rate",
                    'backgroundColor' => 'rgb(37, 106, 154)',
                    'borderColor' => 'rgb(62, 182, 160)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $chart;
    }

    private function getValueForChartLineEvolutionInterest($movements)
    {

        $data = [];

        /** @var ReportingMovement $movement */
        foreach ($movements as $movement)
        {
            if ($movement->getName() === Movement::EARNING)
            {
                $value = end($data);
                $data[] = round(($value + ($movement->getInterestEarn()->getAmount() / 100)), 2);
            }
        }

        return $data;
    }

    private function getDateForChartLineEvolutionInterest($movements)
    {
        $labels = [];

        foreach ($movements as $movement)
        {
            if ($movement->getName() === Movement::EARNING)
            {
                $labels[] = $movement->getCreatedAt()->format('M');
            }
        }

        return $labels;
    }

    private function getDateForChartLineEvolutionRateInterest($movements)
    {
        $labels = [];

        foreach ($movements as $movement)
        {
            if ($movement->getName() === Movement::EARNING)
            {
                $labels[] = $movement->getCreatedAt()->format('M');
            }
        }

        return $labels;
    }

    private function getValueForChartLineEvolutionRateInterest($movements)
    {
        $data = [];

        /** @var ReportingMovement $movement */
        foreach ($movements as $movement)
        {
            if ($movement->getName() === Movement::EARNING)
            {
                $data[] = $movement->getInterestRates();
            }
        }

        return $data;
    }
}