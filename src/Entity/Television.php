<?php

namespace App\Entity;

use App\Repository\TelevisionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelevisionRepository::class)]
class Television
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $Couleur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Nom_fab = null;

    #[ORM\Column(nullable: true)]
    private ?int $Diagonale = null;

    #[ORM\Column(nullable: true)]
    private ?float $Dimensions = null;

    #[ORM\Column(nullable: true)]
    private ?float $Poids = null;

    #[ORM\ManyToOne(inversedBy: 'televisions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marques $Marques = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(?string $Couleur): static
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getNomFab(): ?string
    {
        return $this->Nom_fab;
    }

    public function setNomFab(?string $Nom_fab): static
    {
        $this->Nom_fab = $Nom_fab;

        return $this;
    }

    public function getDiagonale(): ?int
    {
        return $this->Diagonale;
    }

    public function setDiagonale(?int $Diagonale): static
    {
        $this->Diagonale = $Diagonale;

        return $this;
    }

    public function getDimensions(): ?float
    {
        return $this->Dimensions;
    }

    public function setDimensions(?float $Dimensions): static
    {
        $this->Dimensions = $Dimensions;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->Poids;
    }

    public function setPoids(?float $Poids): static
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getMarques(): ?Marques
    {
        return $this->Marques;
    }

    public function setMarques(?Marques $Marques): static
    {
        $this->Marques = $Marques;

        return $this;
    }
}
