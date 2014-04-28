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

        /*
        $user = new user();
        $form = $this->createForm(new userType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // the validation passed, do something with the $author object
            


            return $this->redirect($this->generateUrl('app_recherche', array(
                'users' => $users;
            )));
        }
        */

        $user = $this->get('security.context')->getToken()->getUser();

        return array(
            "actualities" => $actualities,
            "user" => $user,
        );

    }
}