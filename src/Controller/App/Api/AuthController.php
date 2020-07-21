<?php

namespace App\Controller\App\Api;

use App\Entity\Client;
use App\Repository\AdminRepository;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;

class AuthController extends AbstractController
{


    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    public function __construct(ClientRepository $clientRepository,
                                UserPasswordEncoderInterface $userPasswordEncoder,
                                AdminRepository $adminRepository)
    {

        $this->clientRepository = $clientRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->adminRepository = $adminRepository;
    }



    /**
     * @Route("/api/login",
     *     name="login",
     *     methods="POST",
     * )
     */
    public function loginClient(Request $request){
        $client=$this->clientRepository->findOneBy([
            'username'=>$request->get('username')
        ]);

        if ($client){
            $password=$this->userPasswordEncoder->isPasswordValid($client,$request->get('password'));
            if (!$password){
                return new JsonResponse([
                    'code'=>203,
                    'message'=>"Mot de passe incorrect"
                ]);
            }else{
                $userData=$this->clientRepository->getClientData($request->get('username'));
                return new JsonResponse($userData,200);
            }
        }else{
            $admin=$this->adminRepository->findOneBy(['username'=>$request->get('username')]);
            if ($admin){
                $admin_pass=$this->userPasswordEncoder->isPasswordValid($admin,$request->get('password'));
                if (!$admin_pass){
                    return new JsonResponse([
                        'code'=>203,
                        'message'=>"Mot de passe incorrect"
                    ]);
                }else{
                    $adminData=$this->adminRepository->getClientData($request->get('username'));
                    return new JsonResponse($adminData,200);
                }
            }else{
                return new JsonResponse([
                    'code'=>404,
                    'message'=>"Utilisateur non trouvé"
                ]);
            }


        }

     }


}
