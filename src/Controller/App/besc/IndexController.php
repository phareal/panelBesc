<?php

namespace App\Controller\App\besc;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/app/besc/index", name="app_besc_index")
     */
    public function index()
    {
        return $this->render('app/besc/index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
