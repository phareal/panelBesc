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
    private $netWeight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cargoType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $containerSize;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agreementNumber;




    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNetWeight()
    {
        return $this->netWeight;
    }

    /**
     * @param mixed $netWeight
     */
    public function setNetWeight($netWeight): void
    {
        $this->netWeight = $netWeight;
    }

    /**
     * @return mixed
     */
    public function getCargoType()
    {
        return $this->cargoType;
    }

    /**
     * @param mixed $cargoType
     */
    public function setCargoType($cargoType): void
    {
        $this->cargoType = $cargoType;
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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAgreementNumber()
    {
        return $this->agreementNumber;
    }

    /**
     * @param mixed $agreementNumber
     */
    public function setAgreementNumber($agreementNumber): void
    {
        $this->agreementNumber = $agreementNumber;
    }





}
