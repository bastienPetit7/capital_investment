<?php

namespace App\Entity;

use App\Repository\WidgetLineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WidgetLineRepository::class)
 */
class WidgetLine
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
     * @ORM\OneToMany(targetEntity=WidgetContentLine::class, mappedBy="widgetLine", orphanRemoval=true)
     */
    private $widgetContentLines;

    /**
     * @ORM\ManyToOne(targetEntity=Widget::class, inversedBy="widgetLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widget;

    public function __construct()
    {
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
            $widgetContentLine->setWidgetLine($this);
        }

        return $this;
    }

    public function removeWidgetContentLine(WidgetContentLine $widgetContentLine): self
    {
        if ($this->widgetContentLines->removeElement($widgetContentLine)) {
            // set the owning side to null (unless already changed)
            if ($widgetContentLine->getWidgetLine() === $this) {
                $widgetContentLine->setWidgetLine(null);
            }
        }

        return $this;
    }

    public function getWidget(): ?Widget
    {
        return $this->widget;
    }

    public function setWidget(?Widget $widget): self
    {
        $this->widget = $widget;

        return $this;
    }


}
