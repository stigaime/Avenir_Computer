<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category


{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Composer::class)]
    private Collection $composer;

    public function __construct()
    {
        $this->composer = new ArrayCollection();
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

    public function __toString()
{
    return $this->name; // Supposons que 'name' soit le nom de la catégorie
}

    /**
     * @return Collection<int, composer>
     */
    public function getComposer(): Collection
    {
        return $this->composer;
    }

    public function addComposer(Composer $composer): static
    {
        if (!$this->composer->contains($composer)) {
            $this->composer->add($composer);
            $composer->setCategory($this);
        }

        return $this;
    }

    public function removeComposer(Composer $composer): static
    {
        if ($this->composer->removeElement($composer)) {
            // set the owning side to null (unless already changed)
            if ($composer->getCategory() === $this) {
                $composer->setCategory(null);
            }
        }

        return $this;
    }
}
