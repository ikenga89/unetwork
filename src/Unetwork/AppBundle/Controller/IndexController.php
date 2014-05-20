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

        $comment = new Comment();

        /*
        foreach ($actualities as $actuality) {
            $actualityCollection->getActuality()->add($actuality);
        }

        $collection = $this->createForm(new CommentType, $actualityCollection);
        */
        

        
        $form = $this->createForm(new CommentType(), $comment);

        $form->handleRequest($request);

        if ($form->isValid()) {

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
        );

    }
}