<?php

namespace App\Entity;

use App\Repository\ReportingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportingRepository::class)
 */
class Reporting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Investor::class, inversedBy="reportings")
     */
    private $investorId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reportingName;

    /**
     * @ORM\Column(type="float")
     */
    private $wallet;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interets;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $interetsComposé;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getInvestorId(): ?Investor
    {
        return $this->investorId;
    }

    public function setInvestorId(?Investor $investorId): self
    {
        $this->investorId = $investorId;

        return $this;
    }

    public function getReportingName(): ?string
    {
        return $this->reportingName;
    }

    public function setReportingName(?string $reportingName): self
    {
        $this->reportingName = $reportingName;

        return $this;
    }

    public function getWallet(): ?float
    {
        return $this->wallet;
    }

    public function setWallet(float $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function getInterets(): ?float
    {
        return $this->interets;
    }

    public function setInterets(?float $interets): self
    {
        $this->interets = $interets;

        return $this;
    }

    public function getInteretsComposé(): ?float
    {
        return $this->interetsComposé;
    }

    public function setInteretsComposé(?float $interetsComposé): self
    {
        $this->interetsComposé = $interetsComposé;

        return $this;
    }
}
