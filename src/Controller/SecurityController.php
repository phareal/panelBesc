<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    public function showLoginView(AuthenticationUtils $authenticationUtils){
        //recuperation error
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
       return $this->render('auth/login.html.twig',[
           "error"=>$error,
           "lastUsername"=>$lastUsername
       ]);
    }

}
