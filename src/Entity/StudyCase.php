<?php

namespace App\Entity;

use App\Repository\StudyCaseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudyCaseRepository::class)
 */
class StudyCase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ThemeStudyCase::class, inversedBy="studyCases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagePath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileToPath;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDownload;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?ThemeStudyCase
    {
        return $this->theme;
    }

    public function setTheme(?ThemeStudyCase $theme): self
    {
        $this->theme = $theme;

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

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getFileToPath(): ?string
    {
        return $this->fileToPath;
    }

    public function setFileToPath(string $fileToPath): self
    {
        $this->fileToPath = $fileToPath;

        return $this;
    }

    public function getNumberOfDownload(): ?int
    {
        return $this->numberOfDownload;
    }

    public function setNumberOfDownload(int $numberOfDownload): self
    {
        $this->numberOfDownload = $numberOfDownload;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
