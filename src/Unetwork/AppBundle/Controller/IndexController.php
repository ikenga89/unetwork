<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/app/index", name="app_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $actualities = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->findAll();

        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
            ->add('recherche', 'text')
            ->add('rechercher', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Les données sont un tableau avec les clés "name", "email", et "message"
            $data = $form->getData();

            return $this->redirect($this->generateUrl('app_recherche', array('text' => $data['recherche'])));
        }

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

    /**
     * @Route("/app/recherche/{text}", name="app_recherche")
     * @Template()
     */
    public function rechercheAction(Request $request){

        // REQUETE
        // On recupere l'objet depuis Doctrine 
        $em = $this->getDoctrine()->getManager();

        // Requete DQL 
        $query = $em->createQuery(
        'SELECT *
         FROM UnetworkAppBundle:unetwork_users
         WHERE nom = [recherche]' // Cherche le nom de l'user entrer par l'utilisateur
        )->setParameter('nom');

        $products = $query->getResult();
        //


        // AFFICHAGE

    }
}