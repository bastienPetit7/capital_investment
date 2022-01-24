<?php

namespace App\Classe\Monetico\Response;

use App\Classe\Monetico\Response\PaymentResponseTest;

/**
 *  Example of a basic payment response
 */
class BasicPaymentResponseExample extends PaymentResponseTest
{

    public function getName()
    {
        return "Basic payment example";
    }

    public function getDescription()
    {
        return "This is an example of a response that the Monetico platform can send you once a payment has been done.";
    }

    protected function getResponseParametersWithoutMac()
    {

        

        return [
            "TPE" => TPE,
            "date" => "25/05/2020_a_14:31:27",
            "montant" => "123.45EUR",
            "reference" => "ref143106",
            "texte-libre" => "Do not forget to HTML-encode every field value otherwise characters like < or > might cause issues",
            "code-retour" => "payetest",
            "cvx" => "oui",
            "vld" => "1223",
            "brand" => "VI",
            "numauto" => "000000",
            "usage" => "inconnu",
            "typecompte" => "particulier",
            "ecard" => "non",
            "originecb" => "FRA",
            "bincb" => "000001",
            "hpancb" => "6C0F3557D7297149ECCD58CBD6205273F0F3DA7A",
            "ipclient" => "127.0.0.1",
            "originetr" => "ZZZ",
            "modepaiement" => "CB",
            "authentification" => "ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJQQVJlcyIgOiAiWSIsCiAgICAgICJWRVJlcyIgOiAiWSIsCiAgICAgICJzdGF0dXMzRFMiIDogMQogICB9LAogICAicHJvdG9jb2wiIDogIjNEU2VjdXJlIiwKICAgInN0YXR1cyIgOiAiYXV0aGVudGljYXRlZCIsCiAgICJ2ZXJzaW9uIiA6ICIxLjAuMiIKfQo="
        ];
    }
}