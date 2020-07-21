<?php

namespace App\Entity\VgModule;

use App\Entity\Client;
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
     * @ORM\OneToOne(targetEntity="Vgm", inversedBy="payVgm", cascade={"persist", "remove"})
     */
    private $vgm;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointPay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $payAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $payment_method;

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

    public function getVgm(): ?Vgm
    {
        return $this->vgm;
    }

    public function setVgm(?Vgm $vgm): self
    {
        $this->vgm = $vgm;

        return $this;
    }

    public function getPointPay(): ?int
    {
        return $this->pointPay;
    }

    public function setPointPay(int $pointPay): self
    {
        $this->pointPay = $pointPay;

        return $this;
    }

    public function getPayAt(): ?\DateTimeInterface
    {
        return $this->payAt;
    }

    public function setPayAt(\DateTimeInterface $payAt): self
    {
        $this->payAt = $payAt;

        return $this;
    }

    public function getPaymentMethod(): ?int
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(int $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }
}
