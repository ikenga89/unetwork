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
             WHERE u.nom = :recherche' // Cherche le nom de l'user entrer par l'utilisateur
            )->setParameter('recherche',$data['recherche']);

            $users = $query->getResult();


            // on affiche le formulaire dans la vue avec le render
            
            //return $this->redirect($this->generateUrl('app_users', array('users' => $users)));
            return $this->render('UnetworkAppBundle:Recherche:recherche.html.twig', array(
                'users' => $users,
            ));
            
            

        }

        
        return $this->render('UnetworkAppBundle::topbar.html.twig', array(
            'user' => $user,
            'form2' => $form2->createView(),
        ));

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
     * @Route("/app/users", name="app_users")
     * @Template()
     */
    /*
    public function usersAction(){

<<<<<<< HEAD
        if ($form->isValid()){

        // Requete DQL 
        $query = $em->createQuery(
        'SELECT *
         FROM UnetworkAdminBundle:User
         WHERE nom = :[recherche]' // Cherche le nom de l'user entrer par l'utilisateur
        )->setParameter('recherche',$recherche);

        $users = $query->getResult();

        return $this->redirect($this->generateUrl('app_recherche', array('text' => $data['recherche'])));

        }
=======
        return array(
            'users' => $users,
        );
>>>>>>> be4fe0ed88325a964c86e9a3b2c42cbbcde8386c
    }
    */

}
