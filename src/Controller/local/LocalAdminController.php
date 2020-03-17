<?php


namespace App\Controller\local;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LocalAdminController extends AbstractController
{

    public function showLoginForm(AuthenticationUtils $authenticationUtils){;
        $error=$authenticationUtils->getLastAuthenticationError();
        return $this->render('admin/localAdmin/Auth/login.html.twig',compact(
            'error'
        ));
    }
    public function index(){
        return $this->render('admin/localAdmin/index.html.twig');
    }


    public function login(){
        return $this->json([
            '200'
        ]);
    }

}
