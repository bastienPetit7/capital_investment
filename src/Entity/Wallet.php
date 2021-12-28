<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WalletRepository::class)
 */
class Wallet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Investor::class, inversedBy="wallet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $investor;

    /**
     * @ORM\Column(type="integer")
     */
    private $initialAmount;

    /**
     * @ORM\Column(type="integer")
     */
    private $actualAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvestor(): ?Investor
    {
        return $this->investor;
    }

    public function setInvestor(Investor $investor): self
    {
        $this->investor = $investor;

        return $this;
    }

    public function getInitialAmount(): ?int
    {
        return $this->initialAmount;
    }

    public function setInitialAmount(int $initialAmount): self
    {
        $this->initialAmount = $initialAmount;

        return $this;
    }

    public function getActualAmount(): ?int
    {
        return $this->actualAmount;
    }

    public function setActualAmount(int $actualAmount): self
    {
        $this->actualAmount = $actualAmount;

        return $this;
    }
}
