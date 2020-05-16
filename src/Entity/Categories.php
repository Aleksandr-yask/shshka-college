<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="categories", orphanRemoval=true)
     */
    private $car;

    public function __construct()
    {
        $this->car = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Cars[]
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
            $car->setCategories($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->car->contains($car)) {
            $this->car->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getCategories() === $this) {
                $car->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString(): string {
        return $this->getName();
    }


}
