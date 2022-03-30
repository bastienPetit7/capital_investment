<?php

namespace App\Entity;

use App\Repository\WidgetContentLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WidgetContentLineRepository::class)
 */
class WidgetContentLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=WidgetLine::class, inversedBy="widgetContentLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widgetLine;

    /**
     * @ORM\ManyToOne(targetEntity=WidgetCode::class, inversedBy="widgetContentLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widgetCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidgetLine(): ?WidgetLine
    {
        return $this->widgetLine;
    }

    public function setWidgetLine(?WidgetLine $widgetLine): self
    {
        $this->widgetLine = $widgetLine;

        return $this;
    }

    public function getWidgetCode(): ?WidgetCode
    {
        return $this->widgetCode;
    }

    public function setWidgetCode(?WidgetCode $widgetCode): self
    {
        $this->widgetCode = $widgetCode;

        return $this;
    }
}
