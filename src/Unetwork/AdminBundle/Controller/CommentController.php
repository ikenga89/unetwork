<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        ->findBy(Array(),Array('date'=>'DESC'));

        return array("comments"=>$comments);
    }
     /**
     * @Route("/admin/comment/create/{id}", name="admin_comment_create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }
     /**
     * @Route("/admin/comment/edit/{id}", name="admin_comment_edit")
     * @Template()
     */
    public function editAction($id)
    {
          $comment = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Comment')
        ->find($id);

        return array("comment"=>$comment);
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
            'alert',
            "Le commentaire a bien été supprimée"
        );


        return $this->redirect($this->generateUrl('admin_comment'));
    }
}
