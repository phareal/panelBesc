<?php

namespace App\Controller\App\vgm;

use App\Entity\Admin;
use App\Entity\Container;
use App\Entity\ContainerType;

use App\Entity\VgModule\DraftAttachment;
use App\Entity\VgModule\Vgm;
use App\Helpers\Helpers;
use App\Repository\AdminRepository;
use App\Repository\ArmateurRepository;
use App\Repository\ClientRepository;
use App\Repository\ConsignataireRepository;
use App\Repository\ContainerTypeRepository;
use App\Repository\DraftContainerRepository;
use App\Repository\Vgm\ConteneurRepository;
use App\Repository\Vgm\VGMRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CertificatorController extends AbstractController
{


    /**
     * @var AdminRepository
     */
    private $adminRepository;
    /**
     * @var ArmateurRepository
     */
    private $armateurRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var DraftContainerRepository
     */
    private $draftContainerRepository;

    public function __construct(AdminRepository $adminRepository,
                                ArmateurRepository $armateurRepository,
                                ClientRepository $clientRepository,
                                DraftContainerRepository $draftContainerRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->adminRepository = $adminRepository;
        $this->armateurRepository = $armateurRepository;
        $this->clientRepository = $clientRepository;
        $this->entityManager = $entityManager;
        $this->draftContainerRepository = $draftContainerRepository;
    }


    public function createVGM(Request $request,AdminRepository $adminRepository,ContainerTypeRepository $conteneurTypeRepository,ConsignataireRepository $consignataireRepository){
        if (!$this->isGranted('ROLE_CERTIFICATOR')) {
            $this->addFlash('warning','Vous n\'avez pas pas les droits necessaires pour effectuer cette action');
            return $this->redirectToRoute('dashboard');
        }
        $conteneurs=$conteneurTypeRepository->findAll();
        $consignataires=$this->clientRepository->getAllExportator();
        if ($request->isMethod("POST")){
            $data=$request->request;
            $attachments=$request->files->get('attachments');
                $container= new Container();
                $draft=$this->draftContainerRepository->findOneBy([
                    'identificationNumber'=>$data->get('containerNum')
                ]);

                $container->setDraft($draft);
                $container->setNetWeight($data->get('netWeight'));
                 $container->setBooking($data->get('booking'));
                $container->setWaybill($data->get('wayBill'));
                $container->setContainerSize($data->get('containerSize'));
                $container->setSealNumber($data->get('sealNum'));
                $container->setAgreementNumber($data->get("agreementNumber"));
                //set the certifyingOfficer
                $exportateur=$this->clientRepository->find($data->get("consignee"));
                $container->setCompanyId($exportateur->getIfu());
                $container->setCompany($exportateur->getLabel());
                $certUser=$this->adminRepository->find($this->getUser()->getId());
                $container->setCertifyingOfficer($certUser);
                $container->setWeightbridge($data->get("weighBridge"));
                $container->setTransporter($data->get('transporter'));
                $container->setDriver($data->get('driver'));
                $container->setTruckNumber($data->get('truckNumber'));
                $container->setTvfNumber($data->get('dvtNumber'));
                $container->setTvfDate($data->get('dvtCreatedAt'));
                $container->setConsignee($exportateur->getLabel());
               $container->setWeightingDate1($data->get('weightingDate1'));
               $container->setWeightingDate2($data->get('weightingDate2'));
               $container->setRequestTime(new \DateTime("now"));
               $container->setState(0);

               $vgm=new Vgm();
               $vgm->setState(0);//Pas encore valide
                $vgm->setAdmin($certUser);
                $vgm->setContainer($container);
                $vgm->setExportator($exportateur);
                $vgm->setVgmNumber(Helpers::generateIdentificationNumber());

            $this->entityManager->persist($container);
            $this->entityManager->persist($vgm);
            $fileManger=$this->getDoctrine()->getManager();
            foreach ($attachments as $attachment){
                $fileName = md5(uniqid()).'.'.$attachment->guessExtension();
                $containerDir = __DIR__.'/../../../../public/uploads/containerFiles';
                $url=$attachment->move($containerDir,$fileName);
                $draftAttachments=new DraftAttachment();
                $draftAttachments->setUrl($url);
                $draftAttachments->setVgm($vgm);
                $this->entityManager->persist($draftAttachments);
            }
               $this->entityManager->flush();
               $this->addFlash('success','La vgm a bien été créer.En attente de validation');
               return $this->redirectToRoute('dashboard-local:vgm:management:createIndex');

        }else{
            return $this->render('app/vgm/vgm_management/createVgm.html.twig',compact('conteneurs','consignataires'));
        }

    }


    public function getAllCreatedVgm(Request $request,VGMRepository $vgmRepository){
        $vgms=$vgmRepository->getAllVGM($this->getUser()->getId());
        return $this->render('app/vgm/certificator/list.html.twig',compact('vgms'));
    }
}
