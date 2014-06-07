<?php

namespace Unetwork\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\CommentType;
use Unetwork\AdminBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    public function __construct(){
        //$user = $this->get('security.context')->getToken()->getUser();
    }

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

        if ($form1->isValid()) {
            // Les données sont un tableau avec les clés "name", "email", et "message"
            $data = $form1->getData();

            return $this->redirect($this->generateUrl('app_recherche', array('text' => $data['recherche'])));
        }


        return array(
            "actualities" => $actualities,
            "user" => $user,
        );

    }


    /**
     * @Route("/app/comment_new/{actu_id}", name="comment_new")
     */
    public function comment_newAction(Request $request, $actu_id){

        $user = $this->get('security.context')->getToken()->getUser();

        $actuality = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->findOneById($actu_id);

        $content = $request->request->get('content');

        $comment = new Comment();
        $comment->setUser($user);
        $comment->setActualitys($actuality);
        $comment->setContent($content);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $d = array();
        $d['date'] = date('d/m/Y H:i:s');
        $d['nom'] = $user->getNom();
        $d['prenom'] = $user->getPrenom();
        $d['webpath'] = $user->getWebPath();

        return new Response(json_encode($d));
    }

    // Eric : la recherche ici =O
    /**
     * @Route("/app/recherche/{recherche}", name="app_recherche")
     * @Template()
     */
    public function rechercheAction(Request $request, $recherche){


        // on créer le formulaire pour la recherche
        $form = $this->createFormBuilder($task)
            ->add('recherche', 'text')
            ->add('rechercher', 'submit')
            ->getForm();  

        if ($form1->isValid()){

        // Requete DQL 
        $query = $em->createQuery(
        'SELECT *
         FROM UnetworkAdminBundle:User
         WHERE nom = :[recherche]' // Cherche le nom de l'user entrer par l'utilisateur
        )->setParameter('recherche',$recherche);

        $users = $query->getResult();

        return $this->redirect($this->generateUrl('app_recherche', array('text' => $data['recherche'])));

          // on affiche le formulaire dans la vue avec le render    
        return $this->render('UnetworkAppBundle:Recherche:recherche.html.twig', array(
            'form' => $form->createView(),
        ));

        }
    }
    }