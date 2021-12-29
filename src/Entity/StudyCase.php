<?php

namespace App\Entity;

use App\Repository\StudyCaseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Name is required")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagePath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pathToFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDownload = 0;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Price is required")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extensionName;

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

    public function getPathToFile(): ?string
    {
        return $this->pathToFile;
    }

    public function setPathToFile(string $pathToFile): self
    {
        $this->pathToFile = $pathToFile;

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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getExtensionName(): ?string
    {
        return $this->extensionName;
    }

    public function setExtensionName(string $extensionName): self
    {
        $this->extensionName = $extensionName;

        return $this;
    }
}
