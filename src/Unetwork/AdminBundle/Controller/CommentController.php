<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommentController extends Controller
{
    /**
     * @Route("/admin/comment")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
     /**
     * @Route("/admin/comment/create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }
     /**
     * @Route("/admin/comment/edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
     /**
     * @Route("/admin/comment/delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
