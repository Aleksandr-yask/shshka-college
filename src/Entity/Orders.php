<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cars::class, inversedBy="inOrder")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cars;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="inOrder")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clients;

    /**
     * @ORM\Column(type="datetime")
     */
    private $order_datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCars(): ?Cars
    {
        return $this->cars;
    }

    public function setCars(?Cars $cars): self
    {
        $this->cars = $cars;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getOrderDatetime(): ?\DateTimeInterface
    {
        return $this->order_datetime;
    }

    public function setOrderDatetime(\DateTimeInterface $order_datetime): self
    {
        $this->order_datetime = $order_datetime;

        return $this;
    }

    public function __toString(): string {
        return $this->getId();
    }

//    public function getCar
}
