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
		$form = $this->createForm(new InscriptionType());

		$form->handleRequest($request);

		if($form->isValid()){

			$data = $form->getData();

            $message = \Swift_Message::newInstance()
            ->setSubject('Demande d\'inscription')
            ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
            ->setTo('xavier.guien@gmail.com')
            ->setBody($this->renderView('UnetworkPublicBundle:Default:email.txt.twig', array('data' => $data)));
            $this->get('mailer')->send($message);

			return $this->redirect($this->generateUrl('public_thanks'));
		}

        return array('form' => $form->createView());
    }

    /**
     * @Route("/thanks", name="public_thanks")
     * @Template()
     */
    public function thanksAction()
    {

        return array();
    }

}
