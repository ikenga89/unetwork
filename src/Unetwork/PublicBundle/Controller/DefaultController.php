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
     * @Route("/", name="public_home")
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
            ->setTo('maxime.sifflet@gmail.com')
            ->setBody($this->renderView('UnetworkPublicBundle:Default:email.txt.twig', array('data' => $data)));
            $this->get('mailer')->send($message);


            $this->get('session')->getFlashBag()->add(
                'notice',
                'Votre demande d\'inscription à bien été envoyé !'
            );

			return $this->redirect($this->generateUrl('public_home'));
		}



        $facebook = new \Facebook(array(
          'appId'  => '414516295351453',
          'secret' => 'd7e480e45243e668ee39e6c868af52db',
        ));

        $facebook_posts = $facebook->api('/110864882309437/posts');

        return array(
            'posts' => $facebook_posts['data'],
            'form' => $form->createView(),
        );
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
