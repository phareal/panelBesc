<?php

namespace App\Controller\SuperUser;

use App\Entity\Admin;
use App\Entity\Armateur;
use App\Entity\ContainerType;
use App\Entity\Client;
use App\Entity\Company;
use App\Entity\Consignataire;
use App\Entity\Country;
use App\Entity\DraftContainer;
use App\Entity\Port;
use App\Entity\Role;
use App\Helpers\Helpers;
use App\Repository\AdminRepository;
use App\Repository\ArmateurRepository;
use App\Repository\ClientRepository;
use App\Repository\ContainerTypeRepository;
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
     * @var ContainerTypeRepository
     */
    private $containerTypeRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;

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
                                ContainerTypeRepository $containerTypeRepository,
                                ClientRepository $clientRepository,
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
        $this->containerTypeRepository = $containerTypeRepository;
        $this->clientRepository = $clientRepository;
    }

    public function addcontainerType()
    {
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

        $checkUser=$this->adminRepository->findBy([
            'username'=>$formData['username']
        ]);

        if ($checkUser){
            $this->addFlash('warning','Un utilisateur existe deja avec ce username');
            return $this->redirectToRoute('dashboard-su-user:add');
        }else{
            $admin = new Admin();
            $admin->setUsername($formData['username']);
            $admin->setPassword($userPasswordEncoder->encodePassword($admin, $formData['password']));

            $role = $this->roleRepository->find($formData['role_id']);
            $module=$this->moduleRepository->find($formData['module_id']);
            $admin->setRole($role);
            $this->objectManager->persist($admin);
            $this->objectManager->flush();

            if ($formData['module_id']!=0){

                $admin->setModule($module);
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

    public function exportateursIndex(Request $request){
        if ($request->isMethod("POST")){
            //recuperation du role
            //chercher si un gars existe deja avec ce username
            $formData=$request->request;
            $checkExport=$this->clientRepository->findBy([
                'username'=>$formData->get('username')
            ]);
            if ($checkExport){
                $this->addFlash('danger','Un utilisateur existe deja avec ce nom d\'utilisateur');
                return $this->redirectToRoute('dashboard-su-user:exportateurs:index');
            }else{
                //check user with label and ifu

                $checkIfu=$this->clientRepository->findBy(['ifu'=>$formData->get('ifu')]);
                $checkLabel=$this->clientRepository->findBy(['label'=>$formData->get('export_label')]);

                if ($checkLabel){
                    $this->addFlash('danger','Veuillez verifier si ce label  n\'est pas deja utilisé par un utilisateur dans la base' );
                    return $this->redirectToRoute('dashboard-su-user:exportateurs:index');
                }else if($checkIfu){
                    $this->addFlash('danger','Veuillez verifier si  ifu n\'est pas deja utilisé par un utilisateur dans la base' );
                    return $this->redirectToRoute('dashboard-su-user:exportateurs:index');

                }else{
                    //procéder aux insertions dans la base de données
                    $client=new Client();
                    $role=$this->roleRepository->find(8);

                    $client->setUsername($formData->get('username'));
                    $client->setPassword($this->userPasswordEncoder->encodePassword($client,$formData->get('password')));
                    $client->setLabel($formData->get('export_label'));
                    $client->setIfu($formData->get('ifu'));
                    $client->setPhoneTwo($formData->get('phone2'));
                    $client->setPhoneOne($formData->get('phone1'));
                    $client->setMail($formData->get('mail'));
                    $client->setAddress($formData->get('addresse'));
                    $client->setGps($formData->get('gps'));
                    $client->setRole($role);
                    $client->setEnseigneCol($formData->get('enseigne'));
                    $this->objectManager->persist($client);
                    $this->objectManager->flush();
                    $this->addFlash('success','L\'exportateur a été ajouté avec succès' );
                    return $this->redirectToRoute('dashboard-su-user:exportateurs:index');

                }
            }
        }else{
            $exportateurs=$this->clientRepository->getAllExportator();
            return $this->render('admin/super_user_admin/consignataire/exportateurs.html.twig',compact('exportateurs'));

        }

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

    public function cargoType(Request $request)
    {

        $types=$this->containerTypeRepository->findAll();
        if ($request->isMethod('POST')){
            $containerType=new ContainerType();
            $containerType->setLabel($request->request->get('label'));
            $this->objectManager->persist($containerType);
            $this->objectManager->flush();
            $this->addFlash('success','Le type de cargo a bien été ajouté');
            return $this->redirectToRoute('dashboard-su-user:cargoTye:index');

        }
        return $this->render('admin/super_user_admin/cargoType/index.html.twig',compact('types'));
    }

    public function consignataireDetails(Request $request,$id,UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $container=$this->consignataireRepository->getDetails($id);
        if ($request->isMethod("POST")){
            $data=$request->request;
            $consignataire=$this->clientRepository->find($id);
            $consignataire->setUsername($data->get('username'));
            $consignataire->setPassword($userPasswordEncoder->encodePassword($consignataire,$data->get('password')));
            $consignataire->setLabel($data->get('label'));
            $consignataire->setIfu($data->get('ifu'));
            $consignataire->setPhoneOne($data->get('phone1'));
            $consignataire->setPhoneTwo($data->get('phone2'));
            $consignataire->setMail($data->get('mail'));
            $consignataire->setAddress($data->get('addresse'));
            $consignataire->setGps($data->get('gps'));
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($consignataire);
            $entityManager->flush();

            $this->addFlash("success","Mise aà jour effectuer avec success");
            return $this->redirectToRoute('dashboard-su-user:consignataire:details',["id"=>$id]);
        }
        return $this->render('admin/super_user_admin/consignataire/details.html.twig',compact('container'));
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
    public function containerIndex(Request $request)
    {
        $armateurs=$this->armateurRepository->getAll();
        $containers=$this->draftContainerRepository->customFindAll();
        $types=$this->containerTypeRepository->findAll();
        if ($request->isMethod("POST")){
           $this->insertConteneur($request);
        }
        return $this->render('admin/super_user_admin/container/index.html.twig',compact('armateurs','containers','types'));
    }

    public function insertConteneur(Request $_request)
    {

            $request=$_request->request;
        ##SEARCH
            $container=new DraftContainer();
            $container->setContainerSize($request->get('containerSize'));
            $container->setTareWeight($request->get('tareWeight'));
            $container->setProprietaireCode($request->get('proprietaryCode'));
            $container->setGoodCode($request->get('groupCode'));
            $container->setRegisterNumber($request->get('registerNumber'));
            $container->setVerificationNumber($request->get('verificationCode'));
            $container->setIdentificationNumber(Helpers::generateContainerIdentificationNumber($request->get('proprietaryCode'),
                $request->get('groupCode'), $request->get('registerNumber'), $request->get('verificationCode')));

            $containerType=$this->containerTypeRepository->find($request->get('cargoType'));
            $armateur=$this->armateurRepository->find($request->get('armateur_id'));
            $container->setArmateur($armateur);
            $container->setContainer($containerType);
            $this->objectManager->persist($container);
            $this->objectManager->flush();
            $this->addFlash('success','insertion effectué avec success');
            return $this->redirectToRoute('dashboard-su-user:conteneur:index');


    }


}
