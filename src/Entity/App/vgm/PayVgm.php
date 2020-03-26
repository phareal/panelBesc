<?php

namespace App\Entity\App\vgm;

use App\Entity\Client;
use App\Entity\Vgm\VGM;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\vgm\PayVgmRepository")
 */
class PayVgm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="payVgms")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vgm\VGM", inversedBy="payVgm", cascade={"persist", "remove"})
     */
    private $vgm;

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

    public function getVgm(): ?VGM
    {
        return $this->vgm;
    }

    public function setVgm(?VGM $vgm): self
    {
        $this->vgm = $vgm;

        return $this;
    }
}
