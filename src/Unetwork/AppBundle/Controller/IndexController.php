<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/app/index", name="app_index")
     * @Template()
     */
    public function indexAction()
    {
        $actualities = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->findAll();

        return array("actualities"=>$actualities);
    }
}