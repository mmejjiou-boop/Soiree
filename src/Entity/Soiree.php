<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Dj;

#[ORM\Entity(repositoryClass: SoireeRepository::class)]
class Soiree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 100)]
    private ?string $titre = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThan("today")]
    private ?\DateTimeImmutable $dateSoiree = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $dateCreation = null;

    /**
     * @var Collection<int, Dj>
     */
    #[ORM\ManyToMany(targetEntity: Dj::class, inversedBy: 'soirees')]
    private Collection $djs;

    #[ORM\ManyToOne(inversedBy: 'soirees')]
    private ?Theme $theme = null;

    public function __construct()
    {
        $this->djs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDateSoiree(): ?\DateTimeImmutable
    {
        return $this->dateSoiree;
    }

    public function setDateSoiree(\DateTimeImmutable $dateSoiree): static
    {
        $this->dateSoiree = $dateSoiree;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return Collection<int, Dj>
     */
    public function getDjs(): Collection
    {
        return $this->djs;
    }

    public function addDj(Dj $dj): static
    {
        if (!$this->djs->contains($dj)) {
            $this->djs->add($dj);
            $dj->addSoiree($this);
        }

        return $this;
    }

    public function removeDj(Dj $dj): static
    {
        if ($this->djs->removeElement($dj)) {
            $dj->removeSoiree($this);
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }
}