<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="string", length=255)
     */
    private $activeLeft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activeRight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

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
    private $stopLoss;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=PositionType::class, inversedBy="positions")
     */
    private $positionType;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $weekOfCreation;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if(empty($this->createdAt))
        {
            $this->createdAt = new DateTime();
        }
    }

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

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

    public function getWeekOfCreation(): ?string
    {
        return $this->weekOfCreation;
    }

    public function setWeekOfCreation(string $weekOfCreation): self
    {
        $this->weekOfCreation = $weekOfCreation;

        return $this;
    }


    public function getAction()
    {
        return $this->action;
    }


    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }


    public function getActiveLeft()
    {
        return $this->activeLeft;
    }


    public function setActiveLeft($activeLeft)
    {
        $this->activeLeft = $activeLeft;
        return $this;
    }


    public function getActiveRight()
    {
        return $this->activeRight;
    }


    public function setActiveRight($activeRight)
    {
        $this->activeRight = $activeRight;
        return $this;
    }


    public function getPublishedAt()
    {
        return $this->publishedAt;
    }


    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }



}
