<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProfilController extends Controller
{
    /**
     * @Route("/app/profil")
     * @Template()
     */
    public function profilAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();

        $cv = $user->getCv();
        
        return array(
            "user" => $user,
            "cv" => $cv,
        );
    }
}