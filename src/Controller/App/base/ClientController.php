<?php


namespace App\Controller\App\base;


use App\Entity\PointsPurchase;
use App\Entity\VgModule\PayVgm;
use App\Repository\AdminRepository;
use App\Repository\ClientRepository;
use App\Repository\PointsPurchaseRepository;
use App\Repository\Vgm\VGMRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{

    /**
     * @var VGMRepository
     */
    private $vgmRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var AdminRepository
     */
    private $adminRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PointsPurchaseRepository
     */
    private $pointsPurchaseRepository;
    /**
     * @var VGMRepository
     */
    private $vgmRepo;

    public function __construct(VGMRepository $vgmRepository,ClientRepository $clientRepository,
                                AdminRepository $adminRepository,
EntityManagerInterface $entityManager,PointsPurchaseRepository $pointsPurchaseRepository,VGMRepository $vgmRepo)
    {
        $this->vgmRepository = $vgmRepository;
        $this->clientRepository = $clientRepository;
        $this->adminRepository = $adminRepository;
        $this->entityManager = $entityManager;
        $this->pointsPurchaseRepository = $pointsPurchaseRepository;
        $this->vgmRepo = $vgmRepo;
    }



    /*part exportateur */
    public function exportatorIndex(Request $request){
        return $this->render('admin/customer/exportateurs/index.html.twig');
    }

    public function exportatorVgmList()
    {
        $client=$this->getUser();
        $vgms=$this->vgmRepository->getAllMyVgm($this->getUser()->getId());
        return $this->render('admin/customer/exportateurs/vgmList.html.twig',compact('vgms','client'));
    }

    public function exportatorAccount(Request $request)
    {
        $caissiers=$this->adminRepository->getAllCaissier();
        $solde=$this->clientRepository->find($this->getUser()->getId())->getSolde();
        $purchases=$this->pointsPurchaseRepository->getAllMyPurchasesPoint($this->getUser()->getId());
        return $this->render('admin/customer/exportateurs/account.html.twig',compact('caissiers','purchases','solde'));
    }


    public function buyPoint(Request $request){
        //get the current user
        $client=$this->clientRepository->find($this->getUser()->getId());
        $seller=$this->adminRepository->find($request->request->get('seller'));

        $total=$client->getSolde()+$request->request->get('point');
        $purchasePoints=new PointsPurchase();
        $purchasePoints->setClient($client);
        $purchasePoints->setSeller($seller);
        $purchasePoints->setBuyAt(new \DateTime('now'));
        $purchasePoints->setBuyPoint($request->request->get('point'));
        $client->setSolde($total);
        $this->entityManager->persist($purchasePoints);
        $this->entityManager->flush();

        $this->addFlash('success','votre achat de points a bien été validé');
        return $this->redirectToRoute('dashboard-local:vgm:exportateur:myVgm');



    }


    public function  payVgm(Request $request,$id){
            $vgm=$this->vgmRepository->find($id);
            $client=$this->clientRepository->find($this->getUser()->getId());
            $payVgm=new PayVgm();
            $payVgm->setVgm($vgm);
            $payVgm->setClient($client);
            $payVgm->setPointPay(2);
            $client->setSolde($client->getSolde() - 2);
            $payVgm->setPayAt(new \DateTime("now"));
            $vgm->setState(1);
            $this->entityManager->persist($payVgm);
            $this->entityManager->persist($client);
            $this->entityManager->persist($vgm);
            $this->entityManager->flush();
            $this->addFlash('success','Le règlement de votre vgm a bien été effectué');
            return $this->redirectToRoute('dashboard-local:vgm:exportateur:index');


    }

    public function updatePayMethod(Request $request)
    {
        $paymentMethod=json_decode($request->getContent());
        $client=$this->clientRepository->find($this->getUser()->getId());
        $client->setPayMethod($paymentMethod);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();

        return $this->json([
            'code'=>200
        ]);
    }
}
