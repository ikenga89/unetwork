<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProfilController extends Controller
{
    /**
     * @Route("/app/profil/{id}", name="app_profil")
     * @Template()
     */
    public function profilAction($id = NULL)
    {
        if($id){
            $user = $this->getDoctrine()
            ->getRepository('UnetworkAdminBundle:User')
            ->find($id);
        }else{
            $user = $this->get('security.context')->getToken()->getUser();
        }

        $cvs = $user->getCv();

        if($cvs){
            $experiences = $cvs->getExperience();
        }else{
            $experiences = array();
        }
        
        return array(
            "user" => $user,
            "cvs" => $cvs,
            "experiences" => $experiences,
        );
    }
}