<?php

namespace App\Controller\App\vgm;

use App\Entity\Admin;
use App\Entity\Module;
use App\Entity\OtherAdmin;
use App\Repository\App\vgm\ContainerRepository;
use App\Repository\DraftContainerRepository;
use App\Repository\ModuleRepository;
use App\Repository\OtherAdminRepository;
use App\Repository\RoleRepository;
use App\Repository\Vgm\VGMRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class OthersAdminController extends AbstractController
{


    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;
    /**
     * @var OtherAdminRepository
     */
    private $otherAdminRepository;
    /**
     * @var ContainerRepository
     */
    private $containerRepository;
    /**
     * @var VGMRepository
     */
    private $vgmRepository;

    public function __construct(RoleRepository $repository,
                                UserPasswordEncoderInterface $userPasswordEncoder,
                                EntityManagerInterface $entityManager,
                                OtherAdminRepository $otherAdminRepository,
                                ModuleRepository $moduleRepository,
                                VGMRepository $vgmRepository,
                                DraftContainerRepository $containerRepository)
    {
        $this->repository = $repository;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->moduleRepository = $moduleRepository;
        $this->otherAdminRepository = $otherAdminRepository;
        $this->containerRepository = $containerRepository;
        $this->vgmRepository = $vgmRepository;
    }

    public function index(){
        $roles=$this->repository->getSomeRoles();
        $managers=$this->otherAdminRepository->getAllVgmManager();
        return $this->render('app/vgm/others_admin/index.html.twig',compact('roles','managers'));
    }



    public function certificatorIndex(Request $request){
        $roles=$this->repository->getSomeRoles();
        return $this->render('app/vgm/others_admin/certificatorIndex.html.twig',compact('roles'));
    }

    public function create(Request $request)
    {
        $data=json_decode($request->getContent());
        $admin=new Admin();
        $admin->setUsername($data->username);
        $admin->setPassword($this->userPasswordEncoder->encodePassword($admin,$data->password));
        $role=$this->repository->find($data->role_id);
        $module=$this->moduleRepository->find(1);
        $admin->setRole($role);
        $admin->setModule($module);

        $otherAdmin=new OtherAdmin();
        $otherAdmin->setAdmin($admin);
        $this->entityManager->persist($admin);
        $this->entityManager->persist($otherAdmin);
        $this->entityManager->flush();

        return new JsonResponse([
           'code'=>200
        ]);

    }
    public function validatorIndex(Request $request){
        return $this->render('app/vgm/others_admin/validatorIndex.html.twig');
    }


    public function controllerIndex(Request $request){

        if ($request->isMethod("POST")){
            $num=json_decode($request->getContent());
            $container=$this->vgmRepository->getContainerByVgm($num);
            dd($container);
            return new JsonResponse(json_encode($container));
        }else{
            $containers=$this->vgmRepository->getAllContainerByVgm();
            return $this->render('admin/customer/controler/index.html.twig',compact('containers'));
        }

    }

    public function validateControle($id)
    {
        $vgm=$this->vgmRepository->find($id);
        $vgm->setState(3);
        $this->entityManager->persist($vgm);
        $this->entityManager->flush();

        return $this->json([
            'code'=>200
        ]);
    }

}
