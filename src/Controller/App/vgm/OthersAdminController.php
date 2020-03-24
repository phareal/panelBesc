<?php

namespace App\Controller\App\vgm;

use App\Entity\Admin;
use App\Entity\Module;
use App\Entity\OtherAdmin;
use App\Repository\ModuleRepository;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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

    public function __construct(RoleRepository $repository,UserPasswordEncoderInterface $userPasswordEncoder,
                                EntityManagerInterface $entityManager,
                                ModuleRepository $moduleRepository)
    {
        $this->repository = $repository;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->moduleRepository = $moduleRepository;
    }

    public function index(){
        $roles=$this->repository->getSomeRoles();
        return $this->render('app/vgm/others_admin/index.html.twig',compact('roles'));
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


        return new  Response();
    }
    public function validatorIndex(Request $request){
        return $this->render('app/vgm/others_admin/validatorIndex.html.twig');
    }
}
