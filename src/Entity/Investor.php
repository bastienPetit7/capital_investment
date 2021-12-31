<?php

namespace App\Entity;

use App\Dictionary\AvailableStatusMode;
use App\Repository\InvestorRepository;
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
     * @ORM\OneToOne(targetEntity=Wallet::class, mappedBy="investor", cascade={"persist", "remove"})
     */
    private $wallet;

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

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): self
    {
        // set the owning side of the relation if necessary
        if ($wallet->getInvestor() !== $this) {
            $wallet->setInvestor($this);
        }

        $this->wallet = $wallet;

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
}
