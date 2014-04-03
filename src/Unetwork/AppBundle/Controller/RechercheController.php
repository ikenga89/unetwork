<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RechercheController extends Controller
{
    /**
     * @Route("/app/recherche")
     * @Template()
     */
    public function rechercheAction()
    {
        return array();
    }
}