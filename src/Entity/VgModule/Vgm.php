<?php

namespace App\Entity\VgModule;

use App\Entity\Admin;
use App\Entity\Client;

use App\Entity\Container;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Vgm\VGMRepository")
 */
class Vgm
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Container", inversedBy="vGMs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $container;

    /**
     * @ORM\OneToMany(targetEntity="DraftAttachment", mappedBy="container")
     */
    private $attachments;

    /**
     * @ORM\OneToOne(targetEntity="PayVgm", mappedBy="vgm", cascade={"persist", "remove"})
     */
    private $payVgm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="vgms")
     */
    private $admin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="validatedVgms")
     */
    private $validator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="vgms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exportator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vgmNumber;

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

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getValidator(): ?Admin
    {
        return $this->validator;
    }

    public function setValidator(?Admin $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    public function getExportator(): ?Client
    {
        return $this->exportator;
    }

    public function setExportator(?Client $exportator): self
    {
        $this->exportator = $exportator;

        return $this;
    }

    public function getVgmNumber(): ?string
    {
        return $this->vgmNumber;
    }

    public function setVgmNumber(string $vgmNumber): self
    {
        $this->vgmNumber = $vgmNumber;

        return $this;
    }

}
