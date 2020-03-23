<?php


namespace App\Controller;



use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AdminController extends AbstractController
{

    private $router;
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    public function __construct(UrlGeneratorInterface $router,AdminRepository $adminRepository)
    {
        $this->router=$router;
        $this->adminRepository = $adminRepository;
    }

    /**
     * fonction devrant servir à recuperer l'user actuellement connecte
     * @param Request $request
     * @param ResponseInterface $response
     * @return RedirectResponse|Response
     */
    public function index(Request $request){
        if ($this->getUser()!=null){
            $roles=$this->getUser()->getRoles();
            if ($roles[0]=="ROLE_SUPER"){
               return $this->redirectToRoute('dashboard-su:index');
            }else if ($roles[0]=="local administrator"){
                switch ($this->getUser()->module->getId()){
                    case 1 :
                        return  $this->redirectToRoute('dashboard-local:vgm:index');
                        break;
                    case 2 :
                        return  $this->redirectToRoute('dashboard-local:index');
                }

            }
        }else{
            return $this->redirectToRoute('login_form');
        }
        return new Response();


    }

}
