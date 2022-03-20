<?php

namespace App\Entity;

use App\Repository\ReportingDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportingDetailsRepository::class)
 */
class ReportingDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $initialWallet;

    /**
     * @ORM\Column(type="float")
     */
    private $interest;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $compoundInterest;

    /**
     * @ORM\Column(type="float")
     */
    private $actualWallet;

    /**
     * @ORM\ManyToOne(targetEntity=Reporting::class, inversedBy="reportingDetail")
     */
    private $reporting;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getInitialWallet(): ?float
    {
        return $this->initialWallet;
    }

    public function setInitialWallet(float $initialWallet): self
    {
        $this->initialWallet = $initialWallet;

        return $this;
    }

    public function getInterest(): ?float
    {
        return $this->interest;
    }

    public function setInterest(float $interest): self
    {
        $this->interest = $interest;

        return $this;
    }

    public function getCompoundInterest(): ?float
    {
        return $this->compoundInterest;
    }

    public function setCompoundInterest(?float $compoundInterest): self
    {
        $this->compoundInterest = $compoundInterest;

        return $this;
    }

    public function getActualWallet(): ?float
    {
        return $this->actualWallet;
    }

    public function setActualWallet(float $actualWallet): self
    {
        $this->actualWallet = $actualWallet;

        return $this;
    }

    public function getReporting(): ?Reporting
    {
        return $this->reporting;
    }

    public function setReporting(?Reporting $reporting): self
    {
        $this->reporting = $reporting;

        return $this;
    }
}
