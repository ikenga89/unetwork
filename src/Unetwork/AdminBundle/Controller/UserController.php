<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    /**
     * @Route("/admin/user", name="admin_user")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/admin/user/create/{id}", name="admin_user_create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }
    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
    /**
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
