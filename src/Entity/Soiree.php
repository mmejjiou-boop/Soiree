<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }

    public function setTitre(string $titre): static { $this->titre = $titre; return $this; }

    public function getDateSoiree(): ?\DateTimeImmutable { return $this->dateSoiree; }

    public function setDateSoiree(\DateTimeImmutable $dateSoiree): static { $this->dateSoiree = $dateSoiree; return $this; }

    public function getDateCreation(): ?\DateTimeImmutable { return $this->dateCreation; }

    public function setDateCreation(\DateTimeImmutable $dateCreation): static { $this->dateCreation = $dateCreation; return $this; }
}