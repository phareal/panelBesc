<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointsRepository")
 */
class Points
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="points")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?int
    {
        return $this->label;
    }

    public function setLabel(?int $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
