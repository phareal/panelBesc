<?php

namespace App\Controller\App\vgm;

use App\Repository\Vgm\VGMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ValidatorController extends AbstractController
{

    /**
     * @var VGMRepository
     */
    private $repository;

    public function __construct(VGMRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {
        return $this->render('app/vgm/validator/index.html.twig', [
            'controller_name' => 'ValidatorController',
        ]);
    }


    public function viewDetailsVgm($id){
        $vgm=$this->repository->count();
        return $this->render('app/vgm/validator/details.html.twig');
    }
}
