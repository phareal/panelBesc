<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{

    public function showLoginView(){
        return $this->json([
            'message'=>200
        ]);
    }

}
