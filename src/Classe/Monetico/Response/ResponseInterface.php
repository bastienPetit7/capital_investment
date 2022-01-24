<?php

namespace App\Classe\Monetico\Response;

use App\Classe\Monetico\HmacComputer;
use App\Classe\Monetico\MoneticoConfig;

class ResponseInterface
{

    function __construct()
    {
 
        $receivedData = $_SERVER['REQUEST_METHOD'] === 'GET' ? $_GET : $_POST;
        if (array_key_exists("MAC", $receivedData)) {

            $receivedSeal = $receivedData['MAC'];

            unset($receivedData['MAC']); 

            $isSealValidated = (new HmacComputer())->validateSeal($receivedData, MoneticoConfig::CLE_MAC, $receivedSeal);
            if ($isSealValidated) {
              

                $codeRetour = $receivedData["code-retour"];
                $isSandboxPayment = $codeRetour === "payetest";
                $isPaymentValidated = substr($codeRetour, 0, strlen("paiement")) === "paiement";


                if ($isPaymentValidated && !$isSandboxPayment) {
                    // Proceed to delivery
                }

            }
            $this->respondWithSealValidationResult($isSealValidated);
            
        } else {
            throw new \InvalidArgumentException("Unable to verify the sealing since received data did not contain MAC field.");
        }
    }

    private function respondWithSealValidationResult(bool $isSealValidated)
    {
        header("Content-Type: text/plain");
        echo "version=2\ncdr=";
        echo $isSealValidated ? "0" : "1";
    }
}