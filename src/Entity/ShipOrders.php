<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipOrdersRepository")
 */
class ShipOrders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_person;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ship_name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $ship_address;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $ship_city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ship_country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getOrderPerson(): ?int
    {
        return $this->order_person;
    }

    public function setOrderPerson(int $order_person): self
    {
        $this->order_person = $order_person;

        return $this;
    }

    public function getShipName(): ?string
    {
        return $this->ship_name;
    }

    public function setShipName(string $ship_name): self
    {
        $this->ship_name = $ship_name;

        return $this;
    }

    public function getShipAddress(): ?string
    {
        return $this->ship_address;
    }

    public function setShipAddress(string $ship_address): self
    {
        $this->ship_address = $ship_address;

        return $this;
    }

    public function getShipCity(): ?string
    {
        return $this->ship_city;
    }

    public function setShipCity(string $ship_city): self
    {
        $this->ship_city = $ship_city;

        return $this;
    }

    public function getShipCountry(): ?string
    {
        return $this->ship_country;
    }

    public function setShipCountry(string $ship_country): self
    {
        $this->ship_country = $ship_country;

        return $this;
    }
}
