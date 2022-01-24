<?php

namespace App\Classe\Monetico\Request;

use App\Classe\Monetico\Request\OrderContextBilling;

/**
 * Represents the "contexte_commande" field content.
 * See technical documentation for a full explanation of each field and the format to use
 */
class OrderContext implements \JsonSerializable
{
    /**
     * @var OrderContextBilling
     */
    private $orderContextBilling;

    /**
     * @var ?OrderContextClient
     */
    private $orderContextClient;

    /**
     * @var ?OrderContextShipping
     */
    private $orderContextShipping;

    /**
     * @var ?OrderContextShoppingCart
     */
    private $orderContextShoppingCart;

    /**
     * OrderContext constructor.
     *
     * @param ?OrderContextBilling $billing
     */
    public function __construct($billing)
    {
        $this->setOrderContextBilling($billing);
    }

    public function jsonSerialize()
    {
        return array_filter([
            'billing' => $this->getOrderContextBilling(),
            'client' => $this->getOrderContextClient(),
            'shipping' => $this->getOrderContextShipping(),
            'shoppingCart' => $this->getOrderContextShoppingCart()
        ], function ($value) {
            return !is_null($value);
        });
    }

    /**
     * @return OrderContextBilling
     */
    public function getOrderContextBilling(): OrderContextBilling
    {
        return $this->orderContextBilling;
    }

    /**
     * @param OrderContextBilling $orderContextBilling
     */
    public function setOrderContextBilling(OrderContextBilling $orderContextBilling): void
    {
        $this->orderContextBilling = $orderContextBilling;
    }

    /**
     * @return OrderContextClient|null
     */
    public function getOrderContextClient(): ?OrderContextClient
    {
        return $this->orderContextClient;
    }

    /**
     * @param OrderContextClient|null $orderContextClient
     */
    public function setOrderContextClient(?OrderContextClient $orderContextClient): void
    {
        $this->orderContextClient = $orderContextClient;
    }

    /**
     * @return OrderContextShipping|null
     */
    public function getOrderContextShipping(): ?OrderContextShipping
    {
        return $this->orderContextShipping;
    }

    /**
     * @param OrderContextShipping|null $orderContextShipping
     */
    public function setOrderContextShipping(?OrderContextShipping $orderContextShipping): void
    {
        $this->orderContextShipping = $orderContextShipping;
    }

    /**
     * @return OrderContextShoppingCart|null
     */
    public function getOrderContextShoppingCart(): ?OrderContextShoppingCart
    {
        return $this->orderContextShoppingCart;
    }

    /**
     * @param OrderContextShoppingCart|null $orderContextShoppingCart
     */
    public function setOrderContextShoppingCart(?OrderContextShoppingCart $orderContextShoppingCart): void
    {
        $this->orderContextShoppingCart = $orderContextShoppingCart;
    }
}

?>