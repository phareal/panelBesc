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

            if ($roles[0] == "ROLE_SUPER"){
                return $this->redirectToRoute('dashboard-su:index');
            }elseif ($roles[0] == "local administrator" || $roles[0]=="ROLE_CERTIFICATOR" ){
                $module=$this->getUser()->module->getId();
                if ($module ==1){
                    return $this->redirectToRoute('dashboard-local:vgm:index');
                }elseif ($module ==2){
                    return $this->redirectToRoute('dashboard-local:index');
                }
            }elseif ($roles[0] == "ROLE_VALIDATOR"){
                $module=$this->getUser()->module->getId();
                if ($module ==1){
                    return $this->redirect('/dashboard/vgm/validator/');
                }elseif ($module ==2){
                    return $this->redirectToRoute('dashboard-local:index');
                }
            }
          /*  switch ($roles[0]){
                case "ROLE_SUPER":
                    return $this->redirectToRoute('dashboard-su:index');
                    break;
                case "local administrator" || "ROLE_CERTIFICATOR":
                    $module=$this->getUser()->module->getId();
                    switch ($module) {
                        case 1 :

                            break;
                        case 2 :
                            return $this->redirectToRoute('dashboard-local:index');
                            break;
                    }
                    break;
                case "ROLE_VALIDATOR":
                    $module=$this->getUser()->module->getId();
                    switch ($module) {
                        case 1 :
                            return $this->redirect('/dashboard/vgm/validator/');
                            break;
                        case 2 :
                            return $this->redirectToRoute('dashboard-local:index');
                            break;
                    }
                    break;

            }*/
        }else{
            return $this->redirectToRoute('login_form');
        }
        return new Response();

    }

}
