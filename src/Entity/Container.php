<?php

namespace App\Entity;


use App\Entity\VgModule\DraftAttachment;
use App\Entity\VgModule\Vgm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\vgm\ContainerRepository")
 */
class Container
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
     * @ORM\Column(type="string", length=255)
     */
    private $booking;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $waybill;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $consignee;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $sealNumber;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $agreementNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin")
     */
    private $certifyingOfficer;


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
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $truckNumber;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $tvfNumber;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $tvfDate;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $weightingDate1;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $weightingDate2;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DraftContainer")
     * @ORM\JoinColumn(name="draft_id",referencedColumnName="id"))
     */
    private $draft;



    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $companyId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VgModule\Vgm", mappedBy="container")
     */
    private $vGMs;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $company;


    public function __construct()
    {
        $this->attachments = new ArrayCollection();
        $this->vGMs = new ArrayCollection();
    }

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

    public function setCertifyingOfficer($certifyingOfficer): self
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

    public function setCompanyId($companyId): self
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

    public function setWeightingDate1($weightingDate1): self
    {
        $this->weightingDate1 = $weightingDate1;

        return $this;
    }

    public function getWeightingDate2(): ?\DateTimeInterface
    {
        return $this->weightingDate2;
    }

    public function setWeightingDate2($weightingDate2): self
    {
        $this->weightingDate2 = $weightingDate2;

        return $this;
    }

    /**
     * @return Collection|DraftAttachment[]
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(DraftAttachment $attachment): self
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments[] = $attachment;
            $attachment->setContainer($this);
        }

        return $this;
    }



    public function removeAttachment(DraftAttachment $attachment): self
    {
        if ($this->attachments->contains($attachment)) {
            $this->attachments->removeElement($attachment);
            // set the owning side to null (unless already changed)
            if ($attachment->getContainer() === $this) {
                $attachment->setContainer(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * @param mixed $draft
     */
    public function setDraft($draft): void
    {
        $this->draft = $draft;
    }

    public function getVGM(): ?Vgm
    {
        return $this->vGM;
    }

    public function setVGM(?Vgm $vGM): self
    {
        $this->vGM = $vGM;

        return $this;
    }

    /**
     * @return Collection|Vgm[]
     */
    public function getVGMs(): Collection
    {
        return $this->vGMs;
    }

    public function addVGM(Vgm $vGM): self
    {
        if (!$this->vGMs->contains($vGM)) {
            $this->vGMs[] = $vGM;
            $vGM->setContainer($this);
        }

        return $this;
    }

    public function removeVGM(Vgm $vGM): self
    {
        if ($this->vGMs->contains($vGM)) {
            $this->vGMs->removeElement($vGM);
            // set the owning side to null (unless already changed)
            if ($vGM->getContainer() === $this) {
                $vGM->setContainer(null);
            }
        }

        return $this;
    }


}
