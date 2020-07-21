<?php

namespace App\Entity;


use App\Entity\VgModule\Vgm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @ORM\Table(name="admin")
 */
class Admin implements UserInterface,\Serializable
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id",referencedColumnName="id")
     */

    public $role;

    /**
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="module_id",referencedColumnName="id")
     */

    public $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OtherAdmin", mappedBy="admin", orphanRemoval=true)
     */
    private $otherAdmins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VgModule\Vgm", mappedBy="admin")
     */
    private $vgms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VgModule\Vgm", mappedBy="validator")
     */
    private $validatedVgms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PointsPurchase", mappedBy="seller")
     */
    private $pointsPurchases;

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }




    public function __construct()
    {
        $this->modules=new ArrayCollection();
        $this->otherAdmins = new ArrayCollection();
        $this->vGMs = new ArrayCollection();
        $this->validatedVgms = new ArrayCollection();
        $this->pointsPurchases = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getModules()
    {
        return $this->modules;
    }


    public function attachModule(Module $module){
        $this->modules->add($module);
    }

    public function removeModule(Module $module){
        $this->modules->removeElement($module);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
                ]);
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->username, $this->password,)=unserialize($serialized,['allowed_classes'=>false]);

    }

    public function getRoles()
    {
        return array_unique([$this->role->getLabel()]);
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }


    public function getSalt()
    {
        return null;
    }



    public function eraseCredentials()
    {

    }

    public function getPassword()
    {
       return $this->password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|OtherAdmin[]
     */
    public function getOtherAdmins(): Collection
    {
        return $this->otherAdmins;
    }

    public function addOtherAdmin(OtherAdmin $otherAdmin): self
    {
        if (!$this->otherAdmins->contains($otherAdmin)) {
            $this->otherAdmins[] = $otherAdmin;
            $otherAdmin->setAdmin($this);
        }

        return $this;
    }

    public function removeOtherAdmin(OtherAdmin $otherAdmin): self
    {
        if ($this->otherAdmins->contains($otherAdmin)) {
            $this->otherAdmins->removeElement($otherAdmin);
            // set the owning side to null (unless already changed)
            if ($otherAdmin->getAdmin() === $this) {
                $otherAdmin->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VGM[]
     */
    public function getVGMs(): Collection
    {
        return $this->vGMs;
    }

    public function addVGM(Vgm $vGM): self
    {
        if (!$this->vGMs->contains($vGM)) {
            $this->vGMs[] = $vGM;
            $vGM->setAdmin($this);
        }

        return $this;
    }

    public function removeVGM(VGM $vGM): self
    {
        if ($this->vGMs->contains($vGM)) {
            $this->vGMs->removeElement($vGM);
            // set the owning side to null (unless already changed)
            if ($vGM->getAdmin() === $this) {
                $vGM->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VGM[]
     */
    public function getValidatedVgms(): Collection
    {
        return $this->validatedVgms;
    }

    public function addValidatedVgm(VGM $validatedVgm): self
    {
        if (!$this->validatedVgms->contains($validatedVgm)) {
            $this->validatedVgms[] = $validatedVgm;
            $validatedVgm->setValidator($this);
        }

        return $this;
    }

    public function removeValidatedVgm(VGM $validatedVgm): self
    {
        if ($this->validatedVgms->contains($validatedVgm)) {
            $this->validatedVgms->removeElement($validatedVgm);
            // set the owning side to null (unless already changed)
            if ($validatedVgm->getValidator() === $this) {
                $validatedVgm->setValidator(null);
            }
        }

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
            $pointsPurchase->setSeller($this);
        }

        return $this;
    }

    public function removePointsPurchase(PointsPurchase $pointsPurchase): self
    {
        if ($this->pointsPurchases->contains($pointsPurchase)) {
            $this->pointsPurchases->removeElement($pointsPurchase);
            // set the owning side to null (unless already changed)
            if ($pointsPurchase->getSeller() === $this) {
                $pointsPurchase->setSeller(null);
            }
        }

        return $this;
    }





}
