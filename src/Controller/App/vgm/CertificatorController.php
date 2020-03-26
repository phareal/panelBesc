<?php

namespace App\Controller\App\vgm;

use App\Entity\Admin;
use App\Entity\Vgm\Container;
use App\Entity\Vgm\DraftAttachment;
use App\Entity\Vgm\VGM;
use App\Repository\AdminRepository;
use App\Repository\ArmateurRepository;
use App\Repository\ClientRepository;
use App\Repository\DraftContainerRepository;
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


    public function createVGM(Request $request,AdminRepository $adminRepository){
        if (!$this->isGranted('ROLE_CERTIFICATOR')) {
            $this->addFlash('warning','Vous n\'avez pas pas les droits necessaires pour effectuer cette action');
            return $this->redirectToRoute('dashboard');
        }

        if ($request->isMethod("POST")){
            $data=$request->request;
            $attachments=$request->files->get('attachments');
                $container= new Container();
                $draft=$this->draftContainerRepository->findOneBy([
                    'identificationNumber'=>$data->get('identificationNumber')
                ]);
                $container->setDraft($draft);
                $container->setNetWeight($data->get('netWeight'));
                $container->setTareWeight($data->get('tareWeight'));
                 $container->setBooking($data->get('booking'));
                $container->setWaybill($data->get('wayBill'));
                $container->setContainerSize($data->get('containerSize'));
                $container->setSealNumber($data->get('sealNumber'));
                $container->setAgreementNumber($data->get("agreementNumber"));
                //set the certifyingOfficer
                $armateur=$this->clientRepository->findOneBy([
                    'label'=>$data->get("company")
                ]);
                $container->setCompanyId($armateur->getIfu());
                $certUser=$this->adminRepository->find($this->getUser()->getId());
                $container->setCertifyingOfficer($certUser);
                $container->setWeightbridge($data->get("weightBride"));
                $container->setTransporter($data->get('transporter'));
                $container->setDriver($data->get('driver'));
                $container->setTruckNumber($data->get('truckNumber'));
                $container->setTvfNumber($data->get('dvtNumber'));
                $container->setTvfDate($data->get('dvtCreatedAt'));
                $container->setConsignee($armateur->getLabel());
               $container->setWeightingDate1($data->get('weightingDate1'));
               $container->setWeightingDate2($data->get('weightingDate2'));
               $container->setRequestTime(new \DateTime("now"));
               $container->setState(0);

               $vgm=new VGM();
               $vgm->setState(0);//Pas encore valide
                $vgm->setContainer($container);

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
            return $this->render('app/vgm/vgm_management/createVgm.html.twig');
        }

        return new Response();

    }


    public function getAllCreatedVgm(Request $request){
        return new Response();
    }
}
