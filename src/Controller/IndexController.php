<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{

    public function index(){
        return $this->json([
            'code'=>'logged'
        ]);
    }

}
