<?php

namespace App\Entity\Vgm;

use App\Entity\App\vgm\PayVgm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Vgm\VGMRepository")
 */
class VGM
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
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vgm\Container", inversedBy="vGMs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $container;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vgm\DraftAttachment", mappedBy="container")
     */
    private $attachments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\App\vgm\PayVgm", mappedBy="vgm", cascade={"persist", "remove"})
     */
    private $payVgm;

    public function __construct()
    {
        $this->container = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Container[]
     */
    public function getContainer(): Collection
    {
        return $this->container;
    }

    public function addContainer(Container $container): self
    {
        if (!$this->container->contains($container)) {
            $this->container[] = $container;
            $container->setVGM($this);
        }

        return $this;
    }

    public function removeContainer(Container $container): self
    {
        if ($this->container->contains($container)) {
            $this->container->removeElement($container);
            // set the owning side to null (unless already changed)
            if ($container->getVGM() === $this) {
                $container->setVGM(null);
            }
        }

        return $this;
    }

    public function setContainer(?Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function getPayVgm(): ?PayVgm
    {
        return $this->payVgm;
    }

    public function setPayVgm(?PayVgm $payVgm): self
    {
        $this->payVgm = $payVgm;

        // set (or unset) the owning side of the relation if necessary
        $newVgm = null === $payVgm ? null : $this;
        if ($payVgm->getVgm() !== $newVgm) {
            $payVgm->setVgm($newVgm);
        }

        return $this;
    }
}
