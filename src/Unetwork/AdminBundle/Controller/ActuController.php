<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ActuController extends Controller
{
    /**
     * @Route("/admin/actu")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
    /**
     * @Route("/admin/actu/delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
