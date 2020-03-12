<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;



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





}
