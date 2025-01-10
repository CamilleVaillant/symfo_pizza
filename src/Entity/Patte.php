<?php

namespace App\Entity;

use App\Repository\PatteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatteRepository::class)]
class Patte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\OneToMany(targetEntity: Pizza::class, mappedBy: 'patte')]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Pizza $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setPatte($this);
        }

        return $this;
    }

    public function removeRelation(Pizza $relation): static
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getPatte() === $this) {
                $relation->setPatte(null);
            }
        }

        return $this;
    }
}
