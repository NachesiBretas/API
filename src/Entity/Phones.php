<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhonesRepository")
 */
class Phones
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="People")
     * this can be improved making a omposite-primary-key (id_person and phone number) -  lack of time
     */
    private $id_person;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $phone;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdPerson(): ?int
    {
        return $this->id_person;
    }

    public function setIdPerson(string $id_person): self
    {
        $this->id_person = $id_person;

        return $this;
    }
}
