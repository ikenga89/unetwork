<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class OffreController extends Controller
{
    /**
     * @Route("/app/offre", name ="app_offre" )
     * @Template()
     */
    public function offreAction()
    {

        return array();

    }


}
