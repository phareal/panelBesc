<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Admin",mappedBy="modules")
     */
    protected $admins;



    public function __construct()
    {
        $this->admins=new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function attachAdmin(Admin $admin){
        $this->admins->add($admin);
        return $this;
    }

    public function removeAdmin(Admin $admin){
        $this->admins->removeElement($admin);
    }


    public function getAdmins()
    {
        return $this->admins;
    }


    public function setAdmins($admins): void
    {
        $this->admins = $admins;
    }




    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
