<?php

namespace App\Controller\App\vgm;

use App\Entity\Vgm\DraftAttachment;
use App\Repository\Vgm\DraftAttachmentRepository;
use App\Repository\Vgm\VGMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VGMController extends AbstractController
{
    /**
     * @var VGMRepository
     */
    private $vgmRepository;
    /**
     * @var DraftAttachmentRepository
     */
    private $attachmentRepository;

    public function __construct(VGMRepository $vgmRepository,DraftAttachmentRepository $attachmentRepository)
    {
        $this->vgmRepository = $vgmRepository;
        $this->attachmentRepository = $attachmentRepository;
    }

    public function index()
    {
        return $this->render('app/vgm/index.html.twig', [
            'controller_name' => 'VGMController',
        ]);
    }

    public function list()
    {
        $vgms=$this->vgmRepository->getAllVGM();
        return $this->render('app/vgm/validator/vgmList.html.twig',compact('vgms'));
    }

    public function viewDetailsVgm($id){
        $vgm=$this->vgmRepository->find($id);
        $vgmDetails=$this->vgmRepository->getSingleDetails($id);
        $attachments=$this->attachmentRepository->getVGMAttachments($id);
        return $this->render('app/vgm/validator/details.html.twig',compact('vgmDetails','attachments'));
    }

    public function showCompagnie()
    {
        return $this->render('app/vgm/compagnie/index.html.twig');
    }







}
