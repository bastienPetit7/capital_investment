<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PriceInDollarExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('priceInDollar', [$this, 'priceInDollar']),
        ];
    }


    public function priceInDollar($value): string
    {
        $value = $value / 100;
        $formatValue = number_format($value,2,","," ");
        return "$" . $formatValue;
    }
}
