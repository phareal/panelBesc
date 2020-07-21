<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointsPurchaseRepository")
 */
class PointsPurchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="pointsPurchases")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="pointsPurchases")
     */
    private $seller;

    /**
     * @ORM\Column(type="integer")
     */
    private $buyPoint;

    /**
     * @ORM\Column(type="datetime")
     */
    private $buyAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSeller(): ?Admin
    {
        return $this->seller;
    }

    public function setSeller(?Admin $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    public function getBuyPoint(): ?int
    {
        return $this->buyPoint;
    }

    public function setBuyPoint(int $buyPoint): self
    {
        $this->buyPoint = $buyPoint;

        return $this;
    }

    public function getBuyAt(): ?\DateTimeInterface
    {
        return $this->buyAt;
    }

    public function setBuyAt(\DateTimeInterface $buyAt): self
    {
        $this->buyAt = $buyAt;

        return $this;
    }
}
