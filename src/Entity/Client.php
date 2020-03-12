<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ifu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneTwo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $gps;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $enseigneCol;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Armateur", mappedBy="client")
     */
    private $armateurs;

    public function __construct()
    {
        $this->armateurs = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIfu(): ?string
    {
        return $this->ifu;
    }

    public function setIfu(string $ifu): self
    {
        $this->ifu = $ifu;

        return $this;
    }

    public function getPhoneOne(): ?string
    {
        return $this->phoneOne;
    }

    public function setPhoneOne(string $phoneOne): self
    {
        $this->phoneOne = $phoneOne;

        return $this;
    }

    public function getPhoneTwo(): ?string
    {
        return $this->phoneTwo;
    }

    public function setPhoneTwo(?string $phoneTwo): self
    {
        $this->phoneTwo = $phoneTwo;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGps(): ?string
    {
        return $this->gps;
    }

    public function setGps(?string $gps): self
    {
        $this->gps = $gps;

        return $this;
    }

    public function getEnseigneCol(): ?string
    {
        return $this->enseigneCol;
    }

    public function setEnseigneCol(string $enseigneCol): self
    {
        $this->enseigneCol = $enseigneCol;

        return $this;
    }

    /**
     * @return Collection|Armateur[]
     */
    public function getArmateurs(): Collection
    {
        return $this->armateurs;
    }

    public function addArmateur(Armateur $armateur): self
    {
        if (!$this->armateurs->contains($armateur)) {
            $this->armateurs[] = $armateur;
            $armateur->setClient($this);
        }

        return $this;
    }

    public function removeArmateur(Armateur $armateur): self
    {
        if ($this->armateurs->contains($armateur)) {
            $this->armateurs->removeElement($armateur);
            // set the owning side to null (unless already changed)
            if ($armateur->getClient() === $this) {
                $armateur->setClient(null);
            }
        }

        return $this;
    }
}
