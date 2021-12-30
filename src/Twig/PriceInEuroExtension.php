<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PriceInEuroExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('priceInEuros', [$this, 'priceInEuros']),
        ];
    }


    public function priceInEuros($value): string
    {
        $valueInEuro = $value / 100;
        $formatValueInEuyro = number_format($valueInEuro,2,","," ");
        return $formatValueInEuyro . " €";
    }
}
