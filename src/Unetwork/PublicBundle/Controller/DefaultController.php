<?php

namespace Unetwork\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\PublicBundle\Form\InscriptionType;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function homeAction(Request $request)
    {
    	// Création formulaire
		$form = $this->createForm(new InscriptionType());

		$form->handleRequest($request);

		if($form->isValid()){

			$data = $form->getData();
			return $this->redirect($this->generateUrl('thanks'));
		}


        return array('form' => $form);
    }
}
