<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @ORM\Entity
 * @ORM\Table(name="admin")
 */
class Admin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */

    public $user;


    public function getUser()
    {
        return $this->user;
    }


    public function setUser($user): void
    {
        $this->user = $user;
    }



    public function getId(): ?int
    {
        return $this->id;
    }


}
