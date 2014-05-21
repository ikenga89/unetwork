<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\CommentType;
use Unetwork\AdminBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/app/index", name="app_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $actualities = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->findAll();


        $defaultData = array();
        $form1 = $this->createFormBuilder($defaultData)
            ->add('recherche', 'text')
            ->add('rechercher', 'submit')
            ->getForm();

        $comment = new Comment();

        /*
        foreach ($actualities as $actuality) {
            $actualityCollection->getActuality()->add($actuality);
        }

        $collection = $this->createForm(new CommentType, $actualityCollection);
        */
        

        
        $form = $this->createForm(new CommentType(), $comment);

        $form->handleRequest($request);

        if ($form1->isValid()) {
            // Les données sont un tableau avec les clés "name", "email", et "message"
            $data = $form->getData();

            return $this->redirect($this->generateUrl('app_recherche', array('recherche' => $data['recherche'])));
        }

        if ($form->isValid()){

            $comment->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('app_index'));
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

        

        return array(
            "actualities" => $actualities,
            "user" => $user,
            "form" => $form->createView(),
            "form1" => $form1->createView(),
        );

    }

    /**
     * @Route("/app/recherche/{recherche}", name="app_recherche")
     * @Template()
     */
    public function rechercheAction(Request $request, $recherche){

        // REQUETE
        // On recupere l'objet depuis Doctrine 
        $em = $this->getDoctrine()->getManager();

        // Requete DQL 
        $query = $em->createQuery(
        'SELECT *
         FROM UnetworkAdminBundle:User
         WHERE nom = :recherche' // Cherche le nom de l'user entrer par l'utilisateur
        )->setParameter('recherche',$recherche);

        $users = $query->getResult();


        // AFFICHAGE
        return array(
            "users" => $users,
        );

    }
}