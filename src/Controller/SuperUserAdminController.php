<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Role;
use App\Repository\AdminRepository;
use App\Repository\RoleRepository;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SuperUserAdminController extends AbstractController
{


    private $roleRepository;
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    private $objectManager;

    public function __construct(RoleRepository $rolerepository,AdminRepository $adminRepository,EntityManagerInterface $entityManager)
    {
        $this->roleRepository=$rolerepository;
        $this->adminRepository = $adminRepository;
        $this->objectManager=$entityManager;
    }



    public function index()
    {
        return $this->render('admin/super_user_admin/index.html.twig', [
            'controller_name' => 'SuperUserAdminController',
        ]);
    }

    public function users()
    {
        /*afficherts la liste des users {admin et roles }*/
        $roles=$this->roleRepository->getAllRoles();
        $admins=$this->adminRepository->findAll();
        return $this->render('admin/super_user_admin/users/index.html.twig',compact('roles','admins'));
    }

    public function insertUser(Request $request,UserPasswordEncoderInterface $userPasswordEncoder){

        $formData=json_decode($request->getContent(),true);

        $admin=new Admin();
        $admin->setUsername($formData['username']);
        $admin->setPassword($userPasswordEncoder->encodePassword($admin,$formData['password']));

        $role=$this->roleRepository->find($formData['role_id']);
        $admin->setRole($role);
        $this->objectManager->persist($admin);
        $this->objectManager->flush();

        return $this->json([
            'code'=>200
        ]);

    }

    public function deleteUser(Request $request)
    {

        $admin=$this->adminRepository->find($request->get('id'));
        $this->objectManager->remove($admin);
        $this->objectManager->flush();
        return $this->json([
            'code'=>'200',
        ]);
    }


    /*geestion des ports et armateurs*/
    public function insertConteneur(Request $request){

    }
}
