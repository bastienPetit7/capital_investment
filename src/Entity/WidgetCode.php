<?php

namespace App\Entity;

use App\Repository\WidgetCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WidgetCodeRepository::class)
 */
class WidgetCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Name is required")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Display Name is required")
     */
    private $displayName;

    /**
     * @ORM\OneToMany(targetEntity=WidgetContentLine::class, mappedBy="widgetCode", orphanRemoval=true)
     */
    private $widgetContentLines;


    public function __construct()
    {
        $this->widgetLines = new ArrayCollection();
        $this->widgetContentLines = new ArrayCollection();
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

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return Collection|WidgetContentLine[]
     */
    public function getWidgetContentLines(): Collection
    {
        return $this->widgetContentLines;
    }

    public function addWidgetContentLine(WidgetContentLine $widgetContentLine): self
    {
        if (!$this->widgetContentLines->contains($widgetContentLine)) {
            $this->widgetContentLines[] = $widgetContentLine;
            $widgetContentLine->setWidgetCode($this);
        }

        return $this;
    }

    public function removeWidgetContentLine(WidgetContentLine $widgetContentLine): self
    {
        if ($this->widgetContentLines->removeElement($widgetContentLine)) {
            // set the owning side to null (unless already changed)
            if ($widgetContentLine->getWidgetCode() === $this) {
                $widgetContentLine->setWidgetCode(null);
            }
        }

        return $this;
    }

}
