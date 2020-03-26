<?php

namespace App\Controller\App\vgm;

use App\Entity\DraftContainer;
use App\Repository\DraftContainerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VGMManagementController extends AbstractController
{
    /**
     * @var DraftContainerRepository
     */
    private $draftContainerRepository;

    public function __construct(DraftContainerRepository $draftContainerRepository)
   {
       $this->draftContainerRepository = $draftContainerRepository;
   }

    public function index()
    {
        return $this->render('app/vgm/vgm_management/index.html.twig', [
            'controller_name' => 'VGMManagementController',
        ]);
    }

    public function searchVGM(Request $request,$QUERY)
    {
       $results=$this->draftContainerRepository->searchContainer($QUERY);
       return new JsonResponse($results[0]);

    }


    public function fillInput($idNum){

        $results=$this->draftContainerRepository->findByIdNum($idNum);

        return new JsonResponse($results);
    }

}
