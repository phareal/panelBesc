<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConteneurRepository")
 */
class Conteneur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $requestTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $validationTime;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $netWeight;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $tareWeight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $booking;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $waybill;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consignee;

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
    private $sealNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $natureOfGoods;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agreementNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $certifyingOfficer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validatingOfficer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weightbridge;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transporter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $driver;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $truckNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tvfNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tvfDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weightingDate1;

    /**
     * @ORM\Column(type="date")
     */
    private $weightingDate2;


    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="DraftContainer")
     * @ORM\JoinColumn(name="draft_id",referencedColumnName="id"))
     */
    private $draft;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestTime(): ?\DateTimeInterface
    {
        return $this->requestTime;
    }

    public function setRequestTime(\DateTimeInterface $requestTime): self
    {
        $this->requestTime = $requestTime;

        return $this;
    }

    public function getValidationTime(): ?\DateTimeInterface
    {
        return $this->validationTime;
    }

    public function setValidationTime(?\DateTimeInterface $validationTime): self
    {
        $this->validationTime = $validationTime;

        return $this;
    }

    public function getNetWeight(): ?string
    {
        return $this->netWeight;
    }

    public function setNetWeight(string $netWeight): self
    {
        $this->netWeight = $netWeight;

        return $this;
    }

    public function getTareWeight(): ?string
    {
        return $this->tareWeight;
    }

    public function setTareWeight(string $tareWeight): self
    {
        $this->tareWeight = $tareWeight;

        return $this;
    }

    public function getBooking(): ?string
    {
        return $this->booking;
    }

    public function setBooking(string $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function getWaybill(): ?string
    {
        return $this->waybill;
    }

    public function setWaybill(string $waybill): self
    {
        $this->waybill = $waybill;

        return $this;
    }

    public function getConsignee(): ?string
    {
        return $this->consignee;
    }

    public function setConsignee(string $consignee): self
    {
        $this->consignee = $consignee;

        return $this;
    }

    public function getCargoType(): ?string
    {
        return $this->cargoType;
    }

    public function setCargoType(string $cargoType): self
    {
        $this->cargoType = $cargoType;

        return $this;
    }

    public function getContainerSize(): ?string
    {
        return $this->containerSize;
    }

    public function setContainerSize(string $containerSize): self
    {
        $this->containerSize = $containerSize;

        return $this;
    }

    public function getSealNumber(): ?string
    {
        return $this->sealNumber;
    }

    public function setSealNumber(string $sealNumber): self
    {
        $this->sealNumber = $sealNumber;

        return $this;
    }

    public function getNatureOfGoods(): ?string
    {
        return $this->natureOfGoods;
    }

    public function setNatureOfGoods(string $natureOfGoods): self
    {
        $this->natureOfGoods = $natureOfGoods;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAgreementNumber(): ?string
    {
        return $this->agreementNumber;
    }

    public function setAgreementNumber(string $agreementNumber): self
    {
        $this->agreementNumber = $agreementNumber;

        return $this;
    }

    public function getCertifyingOfficer(): ?string
    {
        return $this->certifyingOfficer;
    }

    public function setCertifyingOfficer(string $certifyingOfficer): self
    {
        $this->certifyingOfficer = $certifyingOfficer;

        return $this;
    }

    public function getValidatingOfficer(): ?string
    {
        return $this->validatingOfficer;
    }

    public function setValidatingOfficer(?string $validatingOfficer): self
    {
        $this->validatingOfficer = $validatingOfficer;

        return $this;
    }

    public function getWeightbridge(): ?string
    {
        return $this->weightbridge;
    }

    public function setWeightbridge(string $weightbridge): self
    {
        $this->weightbridge = $weightbridge;

        return $this;
    }

    public function getTransporter(): ?string
    {
        return $this->transporter;
    }

    public function setTransporter(?string $transporter): self
    {
        $this->transporter = $transporter;

        return $this;
    }

    public function getDriver(): ?string
    {
        return $this->driver;
    }

    public function setDriver(?string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getTruckNumber(): ?string
    {
        return $this->truckNumber;
    }

    public function setTruckNumber(string $truckNumber): self
    {
        $this->truckNumber = $truckNumber;

        return $this;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getTvfNumber(): ?string
    {
        return $this->tvfNumber;
    }

    public function setTvfNumber(string $tvfNumber): self
    {
        $this->tvfNumber = $tvfNumber;

        return $this;
    }

    public function getTvfDate(): ?string
    {
        return $this->tvfDate;
    }

    public function setTvfDate(string $tvfDate): self
    {
        $this->tvfDate = $tvfDate;

        return $this;
    }

    public function getWeightingDate1(): ?string
    {
        return $this->weightingDate1;
    }

    public function setWeightingDate1(string $weightingDate1): self
    {
        $this->weightingDate1 = $weightingDate1;

        return $this;
    }

    public function getWeightingDate2(): ?\DateTimeInterface
    {
        return $this->weightingDate2;
    }

    public function setWeightingDate2(\DateTimeInterface $weightingDate2): self
    {
        $this->weightingDate2 = $weightingDate2;

        return $this;
    }
}
