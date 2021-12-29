<?php

namespace App\Entity;

use App\Repository\ThemeStudyCaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ThemeStudyCaseRepository::class)
 */
class ThemeStudyCase
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
     */
    private $imagePath;

    /**
     * @ORM\OneToMany(targetEntity=StudyCase::class, mappedBy="theme")
     */
    private $studyCases;

    public function __construct()
    {
        $this->studyCases = new ArrayCollection();
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

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return Collection|StudyCase[]
     */
    public function getStudyCases(): Collection
    {
        return $this->studyCases;
    }

    public function addStudyCase(StudyCase $studyCase): self
    {
        if (!$this->studyCases->contains($studyCase)) {
            $this->studyCases[] = $studyCase;
            $studyCase->setTheme($this);
        }

        return $this;
    }

    public function removeStudyCase(StudyCase $studyCase): self
    {
        if ($this->studyCases->removeElement($studyCase)) {
            // set the owning side to null (unless already changed)
            if ($studyCase->getTheme() === $this) {
                $studyCase->setTheme(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
