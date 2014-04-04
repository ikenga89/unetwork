<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ActuController extends Controller
{
    /**
     * @Route("/admin/actu", name="admin_actu")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/create/{id}", name="admin_actu_create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/edit/{id}", name="admin_actu_edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/delete/{id}", name="admin_actu_delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
