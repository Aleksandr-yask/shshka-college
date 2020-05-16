<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $fio;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="clients", orphanRemoval=true)
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

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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
            $inOrder->setClients($this);
        }

        return $this;
    }

    public function removeInOrder(Orders $inOrder): self
    {
        if ($this->inOrder->contains($inOrder)) {
            $this->inOrder->removeElement($inOrder);
            // set the owning side to null (unless already changed)
            if ($inOrder->getClients() === $this) {
                $inOrder->setClients(null);
            }
        }

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function __toString(): string {
        return $this->getFio();
    }
}
