<?php

namespace App\Entity;

use App\Repository\CapitalInvestmentAssetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CapitalInvestmentAssetRepository::class)
 */
class CapitalInvestmentAsset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalAsset;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recoveryFoundTotal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalAsset(): ?int
    {
        return $this->totalAsset;
    }

    public function setTotalAsset(?int $totalAsset): self
    {
        $this->totalAsset = $totalAsset;

        return $this;
    }

    public function getRecoveryFoundTotal(): ?int
    {
        return $this->recoveryFoundTotal;
    }

    public function setRecoveryFoundTotal(?int $recoveryFoundTotal): self
    {
        $this->recoveryFoundTotal = $recoveryFoundTotal;

        return $this;
    }
}