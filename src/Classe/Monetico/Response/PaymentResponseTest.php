<?php

namespace App\Classe\Monetico\Response; 

use App\Classe\Monetico\HmacComputer;
use App\Classe\Monetico\MoneticoConfig;

abstract class PaymentResponseTest
{
    public abstract function getName();

    public abstract function getDescription();

    protected abstract function getResponseParametersWithoutMac();

    public function getResponseParameters()
    {
        $parameters = $this->getResponseParametersWithoutMac();
        $parameters["MAC"] = (new HmacComputer())->sealFields($parameters, MoneticoConfig::CLE_MAC);
        return $parameters;
    }
}