<?php

namespace App\Entity;

use App\Repository\InterestEarnRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterestEarnRepository::class)
 */
class InterestEarn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\OneToOne(targetEntity=ReportingMovement::class, inversedBy="interestEarn", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reportingMovement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getReportingMovement(): ?ReportingMovement
    {
        return $this->reportingMovement;
    }

    public function setReportingMovement(ReportingMovement $reportingMovement): self
    {
        $this->reportingMovement = $reportingMovement;

        return $this;
    }
}