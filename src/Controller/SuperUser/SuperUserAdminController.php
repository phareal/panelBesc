<?php

namespace App\Controller\SuperUser;

use App\Entity\Admin;
use App\Entity\Armateur;
use App\Entity\CargoType;
use App\Entity\Client;
use App\Entity\Company;
use App\Entity\Consignataire;
use App\Entity\Country;
use App\Entity\DraftContainer;
use App\Entity\Port;
use App\Entity\Role;
use App\Repository\AdminRepository;
use App\Repository\ArmateurRepository;
use App\Repository\CargoTypeRepository;
use App\Repository\ConsignataireRepository;
use App\Repository\CountryRepository;
use App\Repository\DraftContainerRepository;
use App\Repository\ModuleRepository;
use App\Repository\PortRepository;
use App\Repository\RoleRepository;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class SuperUserAdminController extends AbstractController
{


    private $roleRepository;
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    private $objectManager;
    /**
     * @var CountryRepository
     */
    private $countryRepository;
    /**
     * @var PortRepository
     */
    private $portRepository;
    /**
     * @var ConsignataireRepository
     */
    private $consignataireRepository;
    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;
    /**
     * @var ArmateurRepository
     */
    private $armateurRepository;
    /**
     * @var DraftContainerRepository
     */
    private $draftContainerRepository;
    /**
     * @var CargoTypeRepository
     */
    private $cargoTypeRepository;

    public function __construct(RoleRepository $rolerepository,
                                AdminRepository $adminRepository,
                                EntityManagerInterface $entityManager,
                                CountryRepository $countryRepository,
                                PortRepository $portRepository,
                                RoleRepository $repository,
                                UserPasswordEncoderInterface $userPasswordEncoder,
                                ModuleRepository $moduleRepository,
                                ArmateurRepository $armateurRepository,
                                DraftContainerRepository $draftContainerRepository,
                                CargoTypeRepository $cargoTypeRepository,
                                ConsignataireRepository $consignataireRepository)
    {
        $this->roleRepository = $rolerepository;
        $this->adminRepository = $adminRepository;
        $this->objectManager = $entityManager;
        $this->countryRepository = $countryRepository;
        $this->portRepository = $portRepository;
        $this->consignataireRepository = $consignataireRepository;

        $this->repository = $repository;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->moduleRepository = $moduleRepository;
        $this->armateurRepository = $armateurRepository;
        $this->draftContainerRepository = $draftContainerRepository;
        $this->cargoTypeRepository = $cargoTypeRepository;
    }

    public function addCargoType()
    {
    }
    public function indexCargoType()
    {
        return $this->render('admin/super_user_admin/cargoType/index.html.twig');
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
        $roles = $this->roleRepository->getAllRoles();
        $admins = $this->adminRepository->findAll();
        $modules= $this->moduleRepository->findAll();
        return $this->render('admin/super_user_admin/users/index.html.twig', compact('roles', 'admins','modules'));
    }

    public function insertUser(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $formData = json_decode($request->getContent(), true);

        $admin = new Admin();
        $admin->setUsername($formData['username']);
        $admin->setPassword($userPasswordEncoder->encodePassword($admin, $formData['password']));

        $role = $this->roleRepository->find($formData['role_id']);
        $admin->setRole($role);
        $this->objectManager->persist($admin);
        $this->objectManager->flush();

        if ($formData['module_id']!=0){
            $module=$this->moduleRepository->find($formData['module_id']);
            $admin->attachModule($module);
            $this->objectManager->persist($admin);
            $this->objectManager->flush();
        }else{
            $this->objectManager->persist($admin);
            $this->objectManager->flush();
        }

        return $this->json([
            'code' => 200
        ]);

    }

    public function deleteUser(Request $request)
    {

        $admin = $this->adminRepository->find($request->get('id'));
        $this->objectManager->remove($admin);
        $this->objectManager->flush();
        return $this->json([
            'code' => '200',
        ]);
    }




    public function addConsignataire(Request $request)
    {

        $ports = $this->portRepository->findAll();
        $requestContent=json_decode($request->getContent(),false);
        $consignataire=new Consignataire();
        $client=new Client();
        $client->setUsername($requestContent->username);
        $client->setPassword($this->userPasswordEncoder->encodePassword($client,$requestContent->password));
        $client->setLabel($requestContent->label);
        $client->setIfu($requestContent->ifu);
        $client->setPhoneOne($requestContent->phone_one);
        $client->setPhoneTwo($requestContent->phone_two);
        $client->setMail($requestContent->mail);
        $client->setAddress($requestContent->address);
        $client->setGps($requestContent->gps);
        $client->setEnseigneCol($requestContent->enseign);
        $role=$this->roleRepository->find(2);//on lui donner le role de collaborateur
        $client->setRoles($role);
        $this->objectManager->persist($client);
        $this->objectManager->flush();



        $consignataire->setClient($client);
        $this->objectManager->persist($consignataire);
        $this->objectManager->flush();
        $this->addFlash('success', 'Consignataire ajouter avec success! Knowledge is power!');
        return $this->render("admin/super_user_admin/consignataire/add.html.twig",compact('ports'));

    }



    public function consignataireIndex()
    {
        $ports = $this->portRepository->findAll();
        $consignataires=$this->consignataireRepository->findAll();
        $roles=$this->roleRepository->getAllRoles();
        return $this->render('admin/super_user_admin/consignataire/index.html.twig',compact('ports','consignataires','roles'));
    }



    public function getcountryList()
    {
        $countryList = $this->countryRepository->findAll();
        return $this->render('admin/super_user_admin/country/index.html.twig', compact('countryList'));
    }

    public function getAllShippingPort()
    {
        $ports = $this->portRepository->findAll();
        $countryList = $this->countryRepository->findAll();
        return $this->render('admin/super_user_admin/port/index.html.twig', compact('ports', 'countryList'));
    }

    public function AddShippingPort(Request $request)
    {
        $data = json_decode($request->getContent(), false);
        $port = new Port();
        $port->setLabel($data->port_name);
        $country = $this->countryRepository->find($data->country_id);
        $port->setCountry($country);
        $this->objectManager->persist($port);
        $this->objectManager->flush();
        return $this->json([
            'data' => $port
        ]);
    }

    public function armateurIndex(Request $request)
    {
        $ports = $this->portRepository->findAll();

        $armateurs=$this->armateurRepository->getAll();
        return $this->render('admin/super_user_admin/armateur/index.html.twig',compact('ports','armateurs'));

    }
    public function armateurAdd(Request $request)
    {
        $content=json_decode($request->getContent(),false);

        $client=new Client();
        $client->setUsername($content->username);
        $client->setPassword($this->userPasswordEncoder->encodePassword($client,$content->password));
        $client->setLabel($content->label);
        $client->setIfu($content->ifu);
        $client->setPhoneOne($content->phone_one);
        $client->setPhoneTwo($content->phone_two);
        $client->setMail($content->mail);
        $client->setAddress($content->address);
        $client->setGps($content->gps);
        $client->setEnseigneCol($content->enseign);
        $role=$this->roleRepository->find(2);//on lui donner le role de collaborateur
        $client->setRoles($role);
        $armateur=new Armateur();
        $armateur->setClient($client);
        $armateur->setState($content->type);
        $this->objectManager->persist($client);
        $this->objectManager->persist($armateur);
        $this->objectManager->flush();
        return new Response();
    }


    /*geestion des ports et armateurs*/
    public function containerIndex()
    {
        $armateurs=$this->armateurRepository->getAll();
        $containers=$this->draftContainerRepository->customFindAll();
        $types=$this->cargoTypeRepository->findAll();
        return $this->render('admin/super_user_admin/container/index.html.twig',compact('armateurs','containers','types'));
    }

    public function insertConteneur(Request $request)
    {
        $containerData=json_decode($request->getContent(),false);

        ##SEARCH
        $check=$this->draftContainerRepository->findBy(
            ["proprietaireCode"=>$containerData->proprietaryCode]);
        if ($check){
            $this->addFlash('warning','Un conteneur existe deja avec ce code proprietaire');
            return $this->containerIndex();
        }else{
            $container=new DraftContainer();
            $container->setCargoType($containerData->cargoType);
            $container->setContainerSize($containerData->containerSize);
            $container->setTareWeight($containerData->tareWeight);
            $container->setProprietaireCode($containerData->proprietaryCode);
            $container->setGoodCode($containerData->groupCode);
            $container->setRegisterNumber($containerData->registerNumber);
            $container->setVerificationNumber($containerData->verificationCode);

            $cargoType=$this->cargoTypeRepository->find($containerData->type);
            $armateur=$this->armateurRepository->find($containerData->armateur_id);
            $container->setArmateur($armateur);
            $container->setCargoType($cargoType);
            $this->objectManager->persist($container);
            $this->objectManager->flush();
            return $this->json([
                'code'=>200
            ]);
        }
        return new JsonResponse();

    }
}
