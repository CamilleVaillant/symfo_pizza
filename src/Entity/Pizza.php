<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\Collection;
//lien pour les images
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[Vich\Uploadable]
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

    //rajout d'attribut en private
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

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

    //rajout get et set pour images
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if($imageFile) {
            // si un fichier est chargé, met à jour la date
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

}
