<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DraftContainerRepository")
 */
class DraftContainer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $tareWeight;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $containerSize;


    /**
     * @ORM\ManyToOne(targetEntity="Armateur")
     */
    public $armateur;

    /**
     * @ORM\ManyToOne(targetEntity="ContainerType")
     */

    private $container;

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container): void
    {
        $this->container = $container;
    }



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprietaireCode;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $goodCode;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registerNumber;
    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $verificationNumber;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identificationNumber;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getContainerSize()
    {
        return $this->containerSize;
    }

    /**
     * @param mixed $containerSize
     */
    public function setContainerSize($containerSize): void
    {
        $this->containerSize = $containerSize;
    }

    /**
     * @return mixed
     */
    public function getTareWeight()
    {
        return $this->tareWeight;
    }

    /**
     * @param mixed $tareWeight
     */
    public function setTareWeight($tareWeight): void
    {
        $this->tareWeight = $tareWeight;
    }

    /**
     * @return mixed
     */
    public function getArmateur()
    {
        return $this->armateur;
    }

    /**
     * @param mixed $armateur
     */
    public function setArmateur($armateur): void
    {
        $this->armateur = $armateur;
    }

    /**
     * @return mixed
     */
    public function getProprietaireCode()
    {
        return $this->proprietaireCode;
    }

    /**
     * @param mixed $proprietaireCode
     */
    public function setProprietaireCode($proprietaireCode): void
    {
        $this->proprietaireCode = $proprietaireCode;
    }

    /**
     * @return mixed
     */
    public function getGoodCode()
    {
        return $this->goodCode;
    }

    /**
     * @param mixed $goodCode
     */
    public function setGoodCode($goodCode): void
    {
        $this->goodCode = $goodCode;
    }

    /**
     * @return mixed
     */
    public function getRegisterNumber()
    {
        return $this->registerNumber;
    }

    /**
     * @param mixed $registerNumber
     */
    public function setRegisterNumber($registerNumber): void
    {
        $this->registerNumber = $registerNumber;
    }

    /**
     * @return mixed
     */
    public function getVerificationNumber()
    {
        return $this->verificationNumber;
    }

    /**
     * @param mixed $verificationNumber
     */
    public function setVerificationNumber($verificationNumber): void
    {
        $this->verificationNumber = $verificationNumber;
    }

    /**
     * @return mixed
     */
    public function getIdentificationNumber()
    {
        return $this->identificationNumber;
    }

    /**
     * @param mixed $identificationNumber
     */
    public function setIdentificationNumber($identificationNumber): void
    {
        $this->identificationNumber = $identificationNumber;
    }










}
