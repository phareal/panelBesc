<?php

namespace App\Controller\App\vgm;

use App\Entity\Vgm\DraftAttachment;
use App\Repository\AdminRepository;
use App\Repository\App\vgm\ContainerRepository;
use App\Repository\ClientRepository;
use App\Repository\Vgm\DraftAttachmentRepository;
use App\Repository\Vgm\VGMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @var AdminRepository
     */
    private $adminRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var ContainerRepository
     */
    private $containerRepository;

    public function __construct(VGMRepository $vgmRepository,
                                DraftAttachmentRepository $attachmentRepository,
AdminRepository $adminRepository,ClientRepository $clientRepository,ContainerRepository $containerRepository)
    {
        $this->vgmRepository = $vgmRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->adminRepository = $adminRepository;
        $this->clientRepository = $clientRepository;
        $this->containerRepository = $containerRepository;
    }

    public function index()
    {
        return $this->render('app/vgm/index.html.twig', [
            'controller_name' => 'VGMController',
        ]);
    }

    public function list()
    {
        $vgms=$this->vgmRepository->getAllInQueueVGM();
        return $this->render('app/vgm/validator/vgmList.html.twig',compact('vgms'));
    }

    public function viewDetailsVgm(Request $request,$id){

        $vgm=$this->vgmRepository->find($id);
        if ($request->isMethod('POST')){

            $admin=$this->adminRepository->find($this->getUser()->getId());

            $container=$this->containerRepository->find($request->get('container_id'));
            $exportator=$this->clientRepository->findOneBy([
                'label'=>$request->get('exportateur')
            ]);
            $vgm->setValidator($admin);
            $container->setValidationTime(new \DateTime("now"));
            $exportator->setSolde($exportator->getSolde()-2);
            $vgm->setExportator($exportator);
            $vgm->setState(2);
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($container);

            $entityManager->persist($vgm);
            $entityManager->flush();
            $this->addFlash('success','La vgm a bien été valider');
            return $this->redirectToRoute('dashboard-local:vgm:validaror:vgmDetail',['id'=>$id]);
        }else{

            $vgmDetails=$this->vgmRepository->getSingleDetails($id);
            $user=$this->clientRepository->find($vgmDetails['exportator_id']);
            $attachments=$this->attachmentRepository->getVGMAttachments($id);
            return $this->render('app/vgm/validator/details.html.twig',compact('vgmDetails','attachments','user'));
        }

    }

    public function showCompagnie()
    {
        return $this->render('app/vgm/compagnie/index.html.twig');
    }







}
