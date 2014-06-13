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

        return array(
            "actualities" => $actualities,
            "user" => $user,
        );

    }

    /**
     * @Route("/app/topbar", name="app_topbar")
     * @Template()
     */
    public function topbarAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $defaultData = array();
        $form2 = $this->createFormBuilder($defaultData)
            ->setAction($this->generateUrl('app_topbar'))
            ->setMethod('GET')
            ->add('recherche', 'text')
            ->getForm();

        $form2->handleRequest($request);

        if ($form2->isValid()){

            $data = $form2->getData();

            //modif explode trouver les noms et prenom lors d'une recherche

            $mots = explode(' ', $data['recherche']);
            $parameters = array();

            // on stock la requete dans la variable $dql
            $dql = 'SELECT u FROM UnetworkAdminBundle:User u WHERE ';

            // on affecte chaque mot d'un id pour qu'elle soit unique
            foreach ($mots as $key => $mot) {
                if($key > 0){
                    $dql = $dql .  ' OR ';
                }
                //concaténation de la requete dql avec les mots rechercher         
                $dql = $dql . 'u.nom like :recherche'.$key.' OR u.prenom like :recherche'.$key;
                $parameters['recherche'.$key] = '%'.$mot.'%';
            }
            
            // Requete DQL
            $em = $this->getDoctrine()->getManager();
            // on envoie les données de la requetes qui reçoit les paramètre rentrer par l'utilisateur
            $query = $em->createQuery($dql)->setParameters($parameters);

            $users = $query->getResult();

            return $this->render('UnetworkAppBundle:Recherche:recherche.html.twig', array(
                'users' => $users,
                'recherche' => $data['recherche'],
            ));
        }
        
        return $this->render('UnetworkAppBundle::topbar.html.twig', array(
            'user' => $user,
            'form2' => $form2->createView(),
            
        ));

    }



    /**
     * @Route("/app/autocomplete", name="app_autocomplete")
     */
    public function autocompleteAction(Request $request){


        $search = $request->query->get('search');

        $em = $this->getDoctrine()->getManager();


        $mots = explode(' ', $search);

        $parameters = array();

        // on stock la requete dans la variable $dql
        $dql = 'SELECT u.nom, u.prenom, u.id, u.path FROM UnetworkAdminBundle:User u WHERE ';

        // on affecte chaque mot d'un id pour qu'elle soit unique
        foreach ($mots as $key => $mot) {
            if($key > 0){
                $dql = $dql .  ' OR ';
            }
            //concaténation de la requete dql avec les mots rechercher         
            $dql = $dql . 'u.nom like :recherche'.$key.' OR u.prenom like :recherche'.$key;
            $parameters['recherche'.$key] = $mot.'%';
        }
        
        // Requete DQL
        $em = $this->getDoctrine()->getManager();
        // on envoie les données de la requetes qui reçoit les paramètre rentrer par l'utilisateur
        $query = $em->createQuery($dql)->setParameters($parameters);


        $results = $query->getResult();

        $reponse = array();
        foreach ($results as $result) {
           $reponse[] = array('nom' => $result['nom'], 
                              'prenom' => $result['prenom'], 
                              'id' => $result['id'], 
                              'path' => $result['path'],

                               );
        }

        return new Response(json_encode($reponse));
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


    /**
     * @Route("/app/recherche", name="app_recherche")
     * @Template()
     */
    /*
    public function rechercheAction(Request $request){

        $defaultData = array();
        $form2 = $this->createFormBuilder($defaultData)
            ->setAction($this->generateUrl('app_recherche'))
            ->add('recherche', 'text')
            ->getForm();

        $form2->handleRequest($request);

        if ($form2->isValid()){

            $data = $form2->getData();

            // Requete DQL
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
            'SELECT u
             FROM UnetworkAdminBundle:User u
             WHERE u.nom like :recherche
             OR u.prenom like :recherche' // Cherche le nom de l'user entrer par l'utilisateur
            //)->setParameter('recherche','%'.$data['recherche'].'%');
            )->setParameter('recherche',$data['recherche']);

            $users = $query->getResult();


            // on affiche le formulaire dans la vue avec le render
            
            //return $this->redirect($this->generateUrl('app_recherche', array('users' => serialize($users))));
            return $this->render('UnetworkAppBundle:Recherche:recherche.html.twig', array(
                'users' => $users,
            ));
        }

        return $this->render('UnetworkAppBundle:Index:recherche.html.twig', array(
            'form2' => $form2->createView(),
        ));

    }
    */
    


}
