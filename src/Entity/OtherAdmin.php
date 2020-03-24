<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OtherAdminRepository")
 */
class OtherAdmin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="otherAdmins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $admin;


    public function getId(): ?int
    {
        return $this->id;
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

}
