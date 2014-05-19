<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProfilController extends Controller
{
    /**
     * @Route("/app/profil", name="app_profil")
     * @Template()
     */
    public function profilAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
        /*
        $user_ext = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->find($user->getId());
        */

        $cvs = $user->getCv();

        $experiences = $cvs->getExperience();

        //echo $user->getNom();
        //echo $cv;
        
        return array(
            "user" => $user,
            "cvs" => $cvs,
            "experiences" => $experiences,
        );
    }
}