<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Soiree>
     */
    #[ORM\OneToMany(targetEntity: Soiree::class, mappedBy: 'theme')]
    private Collection $soirees;

    public function __construct()
    {
        $this->soirees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Soiree>
     */
    public function getSoirees(): Collection
    {
        return $this->soirees;
    }

    public function addSoiree(Soiree $soiree): static
    {
        if (!$this->soirees->contains($soiree)) {
            $this->soirees->add($soiree);
            $soiree->setTheme($this);
        }

        return $this;
    }

    public function removeSoiree(Soiree $soiree): static
    {
        if ($this->soirees->removeElement($soiree)) {
            // set the owning side to null (unless already changed)
            if ($soiree->getTheme() === $this) {
                $soiree->setTheme(null);
            }
        }

        return $this;
    }
}
