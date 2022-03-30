<?php

namespace App\Entity;

use App\Repository\WidgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WidgetRepository::class)
 */
class Widget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=WidgetTheme::class, inversedBy="widgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widgetTheme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bgColor;

    /**
     * @ORM\OneToMany(targetEntity=WidgetLine::class, mappedBy="widget", orphanRemoval=true)
     */
    private $widgetLines;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = false;

    public function __construct()
    {
        $this->widgetLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidgetTheme(): ?WidgetTheme
    {
        return $this->widgetTheme;
    }

    public function setWidgetTheme(?WidgetTheme $widgetTheme): self
    {
        $this->widgetTheme = $widgetTheme;

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

    /**
     * @return Collection|WidgetLine[]
     */
    public function getWidgetLines(): Collection
    {
        return $this->widgetLines;
    }

    public function addWidgetLine(WidgetLine $widgetLine): self
    {
        if (!$this->widgetLines->contains($widgetLine)) {
            $this->widgetLines[] = $widgetLine;
            $widgetLine->setWidget($this);
        }

        return $this;
    }

    public function removeWidgetLine(WidgetLine $widgetLine): self
    {
        if ($this->widgetLines->removeElement($widgetLine)) {
            // set the owning side to null (unless already changed)
            if ($widgetLine->getWidget() === $this) {
                $widgetLine->setWidget(null);
            }
        }

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }


    public function getBgColor()
    {
        return $this->bgColor;
    }


    public function setBgColor($bgColor)
    {
        $this->bgColor = $bgColor;

        return $this;
    }


}
