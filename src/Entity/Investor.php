<?php

namespace App\Entity;

use App\Dictionary\AvailableStatusMode;
use App\Repository\InvestorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvestorRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Investor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="investor", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=ListDocument::class, mappedBy="investor", cascade={"persist", "remove"})
     */
    private $listDocument;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = AvailableStatusMode::ACTIVE;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Reporting::class, mappedBy="investorId")
     */
    private $reportings;

    /**
     * @ORM\OneToMany(targetEntity=Wallet::class, mappedBy="investor", orphanRemoval=true)
     */
    private $wallets;

    public function __construct()
    {
        $this->reportings = new ArrayCollection();
        $this->wallets = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist()
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
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


    public function getListDocument(): ?ListDocument
    {
        return $this->listDocument;
    }

    public function setListDocument(ListDocument $listDocument): self
    {
        // set the owning side of the relation if necessary
        if ($listDocument->getInvestor() !== $this) {
            $listDocument->setInvestor($this);
        }

        $this->listDocument = $listDocument;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Reporting[]
     */
    public function getReportings(): Collection
    {
        return $this->reportings;
    }

    public function addReporting(Reporting $reporting): self
    {
        if (!$this->reportings->contains($reporting)) {
            $this->reportings[] = $reporting;
            $reporting->setInvestorId($this);
        }

        return $this;
    }

    public function removeReporting(Reporting $reporting): self
    {
        if ($this->reportings->removeElement($reporting)) {
            // set the owning side to null (unless already changed)
            if ($reporting->getInvestorId() === $this) {
                $reporting->setInvestorId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wallet[]
     */
    public function getWallets(): Collection
    {
        return $this->wallets;
    }

    public function addWallet(Wallet $wallet): self
    {
        if (!$this->wallets->contains($wallet)) {
            $this->wallets[] = $wallet;
            $wallet->setInvestor($this);
        }

        return $this;
    }

    public function removeWallet(Wallet $wallet): self
    {
        if ($this->wallets->removeElement($wallet)) {
            // set the owning side to null (unless already changed)
            if ($wallet->getInvestor() === $this) {
                $wallet->setInvestor(null);
            }
        }

        return $this;
    }
}
