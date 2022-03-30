<?php

namespace App\Entity;

use App\Repository\WidgetRepository;
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
}
