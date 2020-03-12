<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdminController extends AbstractController
{

    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router=$router;
    }

    /**
     * fonction devrant servir à recuperer l'user actuellement connecte
     */
    public function index(){
        if ($this->getUser()!=null){
            $roles=$this->getUser()->getRoles();
            if ($roles[0]=="ROLE_SUPER"){
                return new RedirectResponse($this->generateUrl('dashboard-su:index'));
            }else{
                echo "ds";
            }
        }else{
            return new RedirectResponse('/login');
        }


    }

}
