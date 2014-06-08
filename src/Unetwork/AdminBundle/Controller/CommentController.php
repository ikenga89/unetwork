<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\CommentType;
use Unetwork\AdminBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{

    /**
     * @Route("/admin/comment", name="admin_comment")
     * @Template()
     */
    public function indexAction()
    {
        
        $comments = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Comment')
        ->findBy(Array(),Array('created'=>'DESC'));

        return array("comments"=>$comments);
    }
     /**
     * @Route("/admin/comment/create", name="admin_comment_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_comment'));
        }

        return array("form"=>$form->createView());
    }
     /**
     * @Route("/admin/comment/edit/{id}", name="admin_comment_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {

          $comment = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Comment')
        ->find($id);

        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_comment'));
        }

        return array("form"=>$form->createView());
    }

    /**
     * @Route("/admin/comment/delete/{id}", name="admin_comment_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Comment')
        ->find($id);

        $em->remove($comment);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "Le commentaire a bien été supprimée"
        );


        return $this->redirect($this->generateUrl('admin_comment'));
    }


    /**
     * @Route("/admin/comment/actu/{actuality_id}", name="admin_comment_actu")
     * @Template()
     */
    public function actuAction($actuality_id)
    {
        
        $comments = $this->getDoctrine()
                         ->getRepository('UnetworkAdminBundle:Comment')
                         ->findBy(Array(),Array('created'=>'DESC'));

        $actualities = $this->getDoctrine()
                            ->getRepository('UnetworkAdminBundle:Actuality')
                            ->findBy(Array(),Array('updated'=>'DESC'));

        return array("comments"=>$comments, "actuality_id"=>$actuality_id, "actualities"=>$actualities);
    }

    /**
     * @Route("/admin/comment/delete/actu/{id}/{actuality_id}", name="admin_comment_delete_actu")
     */
    public function actudeleteAction($id,$actuality_id)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Comment')
        ->find($id);

        $em->remove($comment);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            "Le commentaire a bien été supprimée"
        );

        return $this->redirect($this->generateUrl('admin_comment_actu', array('actuality_id' => $actuality_id) ) );
    }
}
