<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $sacret_ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'relation')]
    private ?Patte $patte = null;

    /**
     * @var Collection<int, Ingredients>
     */
    #[ORM\ManyToMany(targetEntity: Ingredients::class, inversedBy: 'pizzas')]
    private Collection $Ingredients;

    public function __construct()
    {
        $this->Ingredients = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSacretIngredient(): ?string
    {
        return $this->sacret_ingredient;
    }

    public function setSacretIngredient(string $sacret_ingredient): static
    {
        $this->sacret_ingredient = $sacret_ingredient;

        return $this;
    }

    public function getPatte(): ?Patte
    {
        return $this->patte;
    }

    public function setPatte(?Patte $patte): static
    {
        $this->patte = $patte;

        return $this;
    }

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngredients(): Collection
    {
        return $this->Ingredients;
    }

    public function addIngredient(Ingredients $ingredient): static
    {
        if (!$this->Ingredients->contains($ingredient)) {
            $this->Ingredients->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): static
    {
        $this->Ingredients->removeElement($ingredient);

        return $this;
    }

   
}
