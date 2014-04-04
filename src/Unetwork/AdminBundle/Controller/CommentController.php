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
        return array();
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
    public function editAction()
    {
        return array();
    }
     /**
     * @Route("/admin/comment/delete/{id}", name="admin_comment_delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
