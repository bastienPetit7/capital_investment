<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $activeLeft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $activeRight;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $action;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $type;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups("user:read")
     */
    private $tp1;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups("user:read")
     */
    private $tp2;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups("user:read")
     */
    private $tp3;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups("user:read")
     */
    private $tp4;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups("user:read")
     */
    private $stopLoss;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @Groups("user:read")
     */
    private $publishedAtAPIFormat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=PositionType::class, inversedBy="positions")
     * @Groups("user:read")
     */
    private $positionType;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     * @Groups("user:read")
     */
    private $weekOfCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $positionState = null;

    /**
     * @Groups("user:read")
     */
    private $positionStateAPIFormat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("user:read")
     */
    private $pips;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTp1()
    {
        return $this->tp1;
    }

    public function setTp1($tp1): self
    {
        $this->tp1 = $tp1;

        return $this;
    }

    public function getTp2()
    {
        return $this->tp2;
    }

    public function setTp2($tp2): self
    {
        $this->tp2 = $tp2;

        return $this;
    }

    public function getTp3()
    {
        return $this->tp3;
    }

    public function setTp3($tp3): self
    {
        $this->tp3 = $tp3;

        return $this;
    }

    public function getTp4()
    {
        return $this->tp4;
    }

    public function setTp4($tp4): self
    {
        $this->tp4 = $tp4;

        return $this;
    }

    public function getStopLoss()
    {
        return $this->stopLoss;
    }

    public function setStopLoss($stopLoss)
    {
        $this->stopLoss = $stopLoss;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
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


    public function getPositionState()
    {
        return $this->positionState;
    }


    public function setPositionState($positionState)
    {
        $this->positionState = $positionState;
        return $this;
    }

    public function getPips(): ?int
    {
        return $this->pips;
    }

    public function setPips(?int $pips): self
    {
        $this->pips = $pips;

        return $this;
    }


    public function getPublishedAtAPIFormat()
    {
        if($this->publishedAt != null)
        {
            return $this->publishedAt->format('Y-m-d');
        }
        return null;
    }

    public function getPositionStateAPIFormat(): string
    {
        switch ($this->positionState)
        {
            case 'tp1':
                return '✅ TP1 HIT ' . $this->tp1;
            case 'tp2':
                return '✅ TP2 HIT ' . $this->tp2;
            case 'tp3':
                return '✅ TP3 HIT ' . $this->tp3;
            case 'tp4':
                return '✅ TP4 HIT ' . $this->tp4;
            case 'stopLoss':
                return '❌ SL HIT ' . $this->stopLoss;
            case 'entryPoint':
                return '🅿️ ENTRY POINT ' . $this->price;
            default:
                return 'PENDING';
        }
    }

}
