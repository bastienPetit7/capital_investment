<?php

namespace App\Services\PaiementMoneticoService;

use App\Entity\User;
use App\Classe\Monetico\Collections\Currency;
use App\Classe\Monetico\Collections\Language;
use App\Classe\Monetico\Request\OrderContext;
use App\Classe\Monetico\Request\PaymentRequest;
use App\Classe\Monetico\Request\OrderContextClient;
use App\Classe\Monetico\Request\OrderContextBilling;
use App\Classe\Monetico\Request\OrderContextShoppingCart;
use App\Classe\Monetico\Request\OrderContextShoppingCartItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  Example of a basic payment request
 */
class CheckoutService 
{
    /**
     * @var PaymentRequest
     */
    private $paymentRequest;

    public function __construct(User $user, $product, $ref)
    {
        $generatedReference = $ref;

        $billing = new OrderContextBilling($user->getAddress(), $user->getCity(), $user->getPostal(), $user->getCountry());

        $billing->setPhone("+33-123456789"); // see technical documentation for correct formatting
        $billing->setFirstName(explode( " ", $user->getName())[0]);
        $billing->setLastName(explode( " ", $user->getName())[1]);
        $billing->setEmail($user->getEmail());

        $client = new OrderContextClient();
        
        $client->setFirstName(explode( " ", $user->getName())[0]);
        $client->setLastName(explode( " ", $user->getName())[1]);
        $client->setEmail($user->getEmail());
        $client->setPhone("+33-123456789"); // see technical documentation for correct formatting
        $client->setLastAccountModification(new \DateTime('2020-09-02'));
        $client->setAuthenticationTimestamp((new \DateTime('-5 minutes')));

        $item = new OrderContextShoppingCartItem();
        $item->setName($product->getName());
        $item->setDescription("ok go");
        $item->setUnitPrice($product->getPrice() / 10);
        $item->setQuantity(1);
        $shopingItem = $item->jsonSerialize();

        $shopingCart = new OrderContextShoppingCart();
        $shopingCart->setShoppingCartItems([$shopingItem]);
   
        $context = new OrderContext($billing);
        $context->setOrderContextClient($client);
        $context->setOrderContextShoppingCart($shopingCart);
        
        $paymentRequest = new PaymentRequest($generatedReference, $product->getPrice()/100, Currency::EUR, Language::FR, $context);
        $paymentRequest->setTexteLibre('Do not forget to HTML-encode every field value otherwise characters like " or \' might cause issues');
        $paymentRequest->setUrlRetourOk($this->getDomain() . '/cgi/success?order_ref=' .$ref ); 
        $paymentRequest->setUrlRetourErreur($this->getDomain() . '/cgi/error?order_ref=' .$ref ); 
       

        $this->setPaymentRequest($paymentRequest);


    }

    public function getDescription()
    {
        return "This example shows a basic payment request using the most usual options.";
    }

    public function getName()
    {
        return "Basic payment request";
    }

    /**
     * @return PaymentRequest
     */
    public function getPaymentRequest(): PaymentRequest
    {
        return $this->paymentRequest;
    }

    /**
     * @param PaymentRequest $paymentRequest
     */
    public function setPaymentRequest(PaymentRequest $paymentRequest): void
    {
        $this->paymentRequest = $paymentRequest;
    }

    public function getDomain()
    {
        return 'https://localhost:8000';
    }
}