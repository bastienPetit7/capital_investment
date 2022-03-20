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
     * @ORM\Column(type="integer",nullable="true")
     */
    private $initialAmount;

    /**
     * @ORM\Column(type="integer",nullable="true")
     */
    private $actualAmount;

    /**
     * @ORM\OneToOne(targetEntity=Reporting::class, mappedBy="wallet", cascade={"persist", "remove"})
     */
    private $reporting;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interestRates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $interestType;

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

    public function setInitialAmount( $initialAmount)
    {
        $this->initialAmount = $initialAmount;

        return $this;
    }

    public function getActualAmount(): ?int
    {
        return $this->actualAmount;
    }

    public function setActualAmount( $actualAmount)
    {
        $this->actualAmount = $actualAmount;

        return $this;
    }

    public function getReporting(): ?Reporting
    {
        return $this->reporting;
    }

    public function setReporting(Reporting $reporting): self
    {
        // set the owning side of the relation if necessary
        if ($reporting->getWallet() !== $this) {
            $reporting->setWallet($this);
        }

        $this->reporting = $reporting;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInterestRates(): ?float
    {
        return $this->interestRates;
    }

    public function setInterestRates(?float $interestRates): self
    {
        $this->interestRates = $interestRates;

        return $this;
    }

    public function getInterestType(): ?string
    {
        return $this->interestType;
    }

    public function setInterestType(?string $interestType): self
    {
        $this->interestType = $interestType;

        return $this;
    }
}
