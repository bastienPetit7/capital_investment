<?php

namespace App\Entity;

use App\Repository\ReportingMovementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReportingMovementRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ReportingMovement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("user:read")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $month;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $year;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("user:read")
     */
    private $interestRates;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $walletAmountBeforeMovement;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $walletAmountAfterMovement;

    /**
     * @ORM\ManyToOne(targetEntity=Reporting::class, inversedBy="reportingMovements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reporting;

    /**
     * @ORM\OneToOne(targetEntity=CashIn::class, mappedBy="reportingMovement", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $cashIn;

    /**
     * @ORM\OneToOne(targetEntity=CashOut::class, mappedBy="reportingMovement", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $cashOut;

    /**
     * @ORM\OneToOne(targetEntity=InterestEarn::class, mappedBy="reportingMovement", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $interestEarn;

    /**
     * @ORM\OneToOne(targetEntity=Bonus::class, mappedBy="reportingMovement", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $bonus;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if(empty($this->createdAt))
        {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getCashIn(): ?CashIn
    {
        return $this->cashIn;
    }

    public function setCashIn(CashIn $cashIn): self
    {
        // set the owning side of the relation if necessary
        if ($cashIn->getReportingMovement() !== $this) {
            $cashIn->setReportingMovement($this);
        }

        $this->cashIn = $cashIn;

        return $this;
    }

    public function getCashOut(): ?CashOut
    {
        return $this->cashOut;
    }

    public function setCashOut(CashOut $cashOut): self
    {
        // set the owning side of the relation if necessary
        if ($cashOut->getReportingMovement() !== $this) {
            $cashOut->setReportingMovement($this);
        }

        $this->cashOut = $cashOut;

        return $this;
    }

    public function getInterestEarn(): ?InterestEarn
    {
        return $this->interestEarn;
    }

    public function setInterestEarn(InterestEarn $interestEarn): self
    {
        // set the owning side of the relation if necessary
        if ($interestEarn->getReportingMovement() !== $this) {
            $interestEarn->setReportingMovement($this);
        }

        $this->interestEarn = $interestEarn;

        return $this;
    }


    public function getWalletAmountBeforeMovement()
    {
        return $this->walletAmountBeforeMovement;
    }


    public function setWalletAmountBeforeMovement($walletAmountBeforeMovement)
    {
        $this->walletAmountBeforeMovement = $walletAmountBeforeMovement;

        return $this;
    }


    public function getWalletAmountAfterMovement()
    {
        return $this->walletAmountAfterMovement;
    }


    public function setWalletAmountAfterMovement($walletAmountAfterMovement)
    {
        $this->walletAmountAfterMovement = $walletAmountAfterMovement;

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


    public function getMonth()
    {
        return $this->month;
    }


    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }


    public function getYear()
    {
        return $this->year;
    }


    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getBonus(): ?Bonus
    {
        return $this->bonus;
    }

    public function setBonus(Bonus $bonus): self
    {
        // set the owning side of the relation if necessary
        if ($bonus->getReportingMovement() !== $this) {
            $bonus->setReportingMovement($this);
        }

        $this->bonus = $bonus;

        return $this;
    }



}
