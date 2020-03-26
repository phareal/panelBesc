<?php


namespace App\Controller\SuperUser;


use App\Repository\AdminRepository;
use App\Repository\ModuleRepository;
use App\Repository\RoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModulesController extends AbstractController
{

    private $roleRepository;
    private $adminRepository;
    private  $moduleRepository;
    private $objectManager;

    public function __construct(RoleRepository $repository,
                                AdminRepository $adminRepository,
                                ModuleRepository $moduleRepository,
                                EntityManagerInterface $objectManager){
        $this->roleRepository=$repository;
        $this->adminRepository=$adminRepository;
        $this->moduleRepository=$moduleRepository;
        $this->objectManager=$objectManager;
    }

    /*recuperer la liste des roles
        des utliisateurs dont le role est different de super user
    */
    public function vgmIndex(Request $request){

        $roles=$this->roleRepository->getManagerRoles();
        $admin=$this->adminRepository->getLocalAdministrator();
        return $this->render('admin/super_user_admin/modules/vgm/index.html.twig',compact('admin'));
    }

    public function addAdminToVGM(Request $request,$module_id,$admin_id){

        $module=$this->moduleRepository->find($module_id);
        $admin=$this->adminRepository->find($admin_id);
        $admin->attachModule($module);
        $this->objectManager->persist($admin);
        $this->objectManager->flush();

        return $this->json([
            'module'=>$module,
            'admin'=>$admin
        ]);
    }






}
