<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReportingRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ReportingRepository::class)
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="datetime", length=255, nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Investor::class, inversedBy="reportings")
     */
    private $investorId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reportingName;

    /**
     * @ORM\OneToMany(targetEntity=ReportingDetails::class, mappedBy="reporting")
     */
    private $reportingDetail;
    

    public function __construct()
    {
        $this->reportingDetail = new ArrayCollection();
    }
    /**
     *@ORM\PrePersist
     */
    public function prePersist(){

        if(empty($this->createdAt)){

            $this->createdAt = new DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|ReportingDetails[]
     */
    public function getReportingDetail(): Collection
    {
        return $this->reportingDetail;
    }

    public function addReportingDetail(ReportingDetails $reportingDetail): self
    {
        if (!$this->reportingDetail->contains($reportingDetail)) {
            $this->reportingDetail[] = $reportingDetail;
            $reportingDetail->setReporting($this);
        }

        return $this;
    }

    public function removeReportingDetail(ReportingDetails $reportingDetail): self
    {
        if ($this->reportingDetail->removeElement($reportingDetail)) {
            // set the owning side to null (unless already changed)
            if ($reportingDetail->getReporting() === $this) {
                $reportingDetail->setReporting(null);
            }
        }

        return $this;
    }
}
