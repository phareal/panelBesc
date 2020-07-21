<?php


namespace App\Controller\App\Api;


use App\Repository\Vgm\VGMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @var VGMRepository
     */
    private $vgmRepository;

    public function __construct(VGMRepository $vgmRepository)
    {
        $this->vgmRepository = $vgmRepository;
    }

    /**
     * @Route("/api/validator/{validator_id}/inqueue-vgm-list",
     *  name="getInqueueVGM",
     *  methods="GET",
     *     )
     */

    public function loadValidators(Request $request,$validator_id){
        return $this->json($this->vgmRepository->getAllInQueueVGM());
    }
}
