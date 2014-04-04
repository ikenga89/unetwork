<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController extends Controller
{
    /**
     * @Route("/admin/community")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/admin/community/create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }

    /**
     * @Route("/admin/community/edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }

    /**
     * @Route("/admin/community/delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }


}