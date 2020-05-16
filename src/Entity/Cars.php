<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
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
    private $auto_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $chattel;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="cars", orphanRemoval=true)
     */
    private $inOrder;

    public function __construct()
    {
        $this->inOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutoNumber(): ?string
    {
        return $this->auto_number;
    }

    public function setAutoNumber(string $auto_number): self
    {
        $this->auto_number = $auto_number;

        return $this;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getChattel(): ?string
    {
        return $this->chattel;
    }

    public function setChattel(string $chattel): self
    {
        $this->chattel = $chattel;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getInOrder(): Collection
    {
        return $this->inOrder;
    }

    public function addInOrder(Orders $inOrder): self
    {
        if (!$this->inOrder->contains($inOrder)) {
            $this->inOrder[] = $inOrder;
            $inOrder->setCars($this);
        }

        return $this;
    }

    public function removeInOrder(Orders $inOrder): self
    {
        if ($this->inOrder->contains($inOrder)) {
            $this->inOrder->removeElement($inOrder);
            // set the owning side to null (unless already changed)
            if ($inOrder->getCars() === $this) {
                $inOrder->setCars(null);
            }
        }

        return $this;
    }

    public function __toString(): string {
        return $this->getName();
    }
}
