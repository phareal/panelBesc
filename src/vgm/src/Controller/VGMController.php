<?php


namespace App\vgm\src\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class VGMController extends AbstractController
{


    public function index(){
        return $this->render('admin/super_user_admin/modules/vgm/index.html.twig');
    }


}
