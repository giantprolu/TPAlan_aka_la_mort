<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    /**
     * @var Collection<int, Television>
     */
    #[ORM\OneToMany(targetEntity: Television::class, mappedBy: 'Marques')]
    private Collection $televisions;

    public function __construct()
    {
        $this->televisions = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Television>
     */
    public function getTelevisions(): Collection
    {
        return $this->televisions;
    }

    public function addTelevision(Television $television): static
    {
        if (!$this->televisions->contains($television)) {
            $this->televisions->add($television);
            $television->setMarques($this);
        }

        return $this;
    }

    public function removeTelevision(Television $television): static
    {
        if ($this->televisions->removeElement($television)) {
            // set the owning side to null (unless already changed)
            if ($television->getMarques() === $this) {
                $television->setMarques(null);
            }
        }

        return $this;
    }
}
