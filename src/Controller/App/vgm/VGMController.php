<?php

namespace App\Controller\App\vgm;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VGMController extends AbstractController
{
    /**
     * @Route("/app/management/v/g/m", name="app_vgm_v_g_m")
     */
    public function index()
    {
        return $this->render('app/vgm/index.html.twig', [
            'controller_name' => 'VGMController',
        ]);
    }

    public function showCompagnie()
    {
        return $this->render('app/vgm/compagnie/index.html.twig');
    }





}
