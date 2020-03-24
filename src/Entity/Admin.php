<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @ORM\Entity
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
        return [$this->role->getLabel()];
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





}
