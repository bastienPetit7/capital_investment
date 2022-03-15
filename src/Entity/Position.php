<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
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
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp4;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp5;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp6;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp7;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tp8;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $stopLoss;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sellAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=PositionType::class, inversedBy="positions")
     */
    private $positionType;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTp1(): ?float
    {
        return $this->tp1;
    }

    public function setTp1(?float $tp1): self
    {
        $this->tp1 = $tp1;

        return $this;
    }

    public function getTp2(): ?float
    {
        return $this->tp2;
    }

    public function setTp2(?float $tp2): self
    {
        $this->tp2 = $tp2;

        return $this;
    }

    public function getTp3(): ?float
    {
        return $this->tp3;
    }

    public function setTp3(?float $tp3): self
    {
        $this->tp3 = $tp3;

        return $this;
    }

    public function getTp4(): ?float
    {
        return $this->tp4;
    }

    public function setTp4(?float $tp4): self
    {
        $this->tp4 = $tp4;

        return $this;
    }

    public function getTp5(): ?float
    {
        return $this->tp5;
    }

    public function setTp5(?float $tp5): self
    {
        $this->tp5 = $tp5;

        return $this;
    }

    public function getTp6(): ?float
    {
        return $this->tp6;
    }

    public function setTp6(?float $tp6): self
    {
        $this->tp6 = $tp6;

        return $this;
    }

    public function getTp7(): ?float
    {
        return $this->tp7;
    }

    public function setTp7(?float $tp7): self
    {
        $this->tp7 = $tp7;

        return $this;
    }

    public function getTp8(): ?float
    {
        return $this->tp8;
    }

    public function setTp8(?float $tp8): self
    {
        $this->tp8 = $tp8;

        return $this;
    }

    public function getStopLoss(): ?float
    {
        return $this->stopLoss;
    }

    public function setStopLoss(?float $stopLoss): self
    {
        $this->stopLoss = $stopLoss;

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

    public function getSellAt(): ?float
    {
        return $this->sellAt;
    }

    public function setSellAt(?float $sellAt): self
    {
        $this->sellAt = $sellAt;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getPositionType(): ?PositionType
    {
        return $this->positionType;
    }

    public function setPositionType(?PositionType $positionType): self
    {
        $this->positionType = $positionType;

        return $this;
    }
}
