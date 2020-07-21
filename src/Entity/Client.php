<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\App\vgm\PayVgm;
use App\Entity\VgModule\Vgm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 *  @ORM\Table(name="client")
 */
class Client implements UserInterface, \Serializable
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


    /**
     * @ORM\Column(type="string",length=55)
     */
    private $username;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id",referencedColumnName="id")
     */
    public $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VgModule\PayVgm", mappedBy="client")
     */
    private $payVgms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VgModule\Vgm", mappedBy="exportator")
     */
    private $vgms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PointsPurchase", mappedBy="client")
     */
    private $pointsPurchases;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $payMethod;



    public function __construct()
    {
        $this->armateurs = new ArrayCollection();
        $this->points = new ArrayCollection();
        $this->payVgms = new ArrayCollection();
        $this->vgms = new ArrayCollection();
        $this->pointsPurchases = new ArrayCollection();
    }

    public function setUsername($username){
        $this->username=$username;
    }

    public function setPassword($password){
        $this->password=$password;
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

    public function serialize()
    {
       return serialize([$this->id,$this->username,$this->password]);
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->username, $this->password,)=unserialize($serialized,['allowed_classes'=>false]);
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {

    }



    /**
     * @return Collection|PayVgm[]
     */
    public function getPayVgms(): Collection
    {
        return $this->payVgms;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getRoles()
    {
       return array_unique([$this->role->getLabel()]);
    }

    /**
     * @return Collection|Vgm[]
     */
    public function getVgms(): Collection
    {
        return $this->vgms;
    }

    public function addVgm(Vgm $vgm): self
    {
        if (!$this->vgms->contains($vgm)) {
            $this->vgms[] = $vgm;
            $vgm->setExportator($this);
        }

        return $this;
    }

    public function removeVgm(Vgm $vgm): self
    {
        if ($this->vgms->contains($vgm)) {
            $this->vgms->removeElement($vgm);
            // set the owning side to null (unless already changed)
            if ($vgm->getExportator() === $this) {
                $vgm->setExportator(null);
            }
        }

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection|PointsPurchase[]
     */
    public function getPointsPurchases(): Collection
    {
        return $this->pointsPurchases;
    }

    public function addPointsPurchase(PointsPurchase $pointsPurchase): self
    {
        if (!$this->pointsPurchases->contains($pointsPurchase)) {
            $this->pointsPurchases[] = $pointsPurchase;
            $pointsPurchase->setClient($this);
        }

        return $this;
    }

    public function removePointsPurchase(PointsPurchase $pointsPurchase): self
    {
        if ($this->pointsPurchases->contains($pointsPurchase)) {
            $this->pointsPurchases->removeElement($pointsPurchase);
            // set the owning side to null (unless already changed)
            if ($pointsPurchase->getClient() === $this) {
                $pointsPurchase->setClient(null);
            }
        }

        return $this;
    }

    public function getPayMethod(): ?int
    {
        return $this->payMethod;
    }

    public function setPayMethod(?int $payMethod): self
    {
        $this->payMethod = $payMethod;

        return $this;
    }




}
