<?php

namespace App\Controller\App\vgm;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VGMManagementController extends AbstractController
{
    /**
     * @Route("/app/vgm/v/g/m/management", name="app_vgm_v_g_m_management")
     */
    public function index()
    {
        return $this->render('app/vgm/vgm_management/index.html.twig', [
            'controller_name' => 'VGMManagementController',
        ]);
    }
    public function createVGM(){
        return $this->render('app/vgm/vgm_management/createVgm.html.twig');
    }
}
