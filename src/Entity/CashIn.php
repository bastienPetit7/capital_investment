<?php

namespace App\Entity;

use App\Repository\CashInRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CashInRepository::class)
 */
class CashIn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $amount;

    /**
     * @ORM\OneToOne(targetEntity=ReportingMovement::class, inversedBy="cashIn", cascade={"persist", "remove"})
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
