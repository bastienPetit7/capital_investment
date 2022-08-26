<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReportingRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReportingRepository::class)
 */
class Reporting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Wallet::class, inversedBy="reporting", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $wallet;

    /**
     * @ORM\OneToMany(targetEntity=ReportingMovement::class, mappedBy="reporting", orphanRemoval=true)
     * @Groups("user:read")
     */
    private $reportingMovements;

    public function __construct()
    {
        $this->reportingMovements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     * @return Collection|ReportingMovement[]
     */
    public function getReportingMovements(): Collection
    {
        return $this->reportingMovements;
    }

    public function addReportingMovement(ReportingMovement $reportingMovement): self
    {
        if (!$this->reportingMovements->contains($reportingMovement)) {
            $this->reportingMovements[] = $reportingMovement;
            $reportingMovement->setReporting($this);
        }

        return $this;
    }

    public function removeReportingMovement(ReportingMovement $reportingMovement): self
    {
        if ($this->reportingMovements->removeElement($reportingMovement)) {
            // set the owning side to null (unless already changed)
            if ($reportingMovement->getReporting() === $this) {
                $reportingMovement->setReporting(null);
            }
        }

        return $this;
    }
}
