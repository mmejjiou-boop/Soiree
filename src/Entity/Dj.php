<?php

namespace App\Entity;

use App\Repository\DjRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DjRepository::class)]
class Dj
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $style = null;

    #[ORM\ManyToMany(targetEntity: Soiree::class, mappedBy: 'djs')]
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

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): static
    {
        $this->style = $style;

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
            $soiree->addDj($this);
        }

        return $this;
    }

    public function removeSoiree(Soiree $soiree): static
    {
        if ($this->soirees->removeElement($soiree)) {
            $soiree->removeDj($this);
        }

        return $this;
    }
}