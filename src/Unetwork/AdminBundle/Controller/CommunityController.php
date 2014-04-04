<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommunityController extends Controller
{
    /**
     * @Route("/admin/community", name="admin_community")
     * @Template()
     */
    public function indexAction()
    {
        $communities = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->findAll();

        return array("communities" => $communities);
    }

    /**
     * @Route("/admin/community/create", name="admin_community_create")
     * @Template()
     */
    public function createAction()
    {
        return array();
    }

    /**
     * @Route("/admin/community/edit/{id}", name="admin_community_edit")
     * @Template()
     */
    public function editAction($id)
    {   
        $community = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->find($id);

        return array('community' => $community);
    }

    /**
     * @Route("/admin/community/delete/{id}", name="admin_community_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $community = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->find($id);

        return array('community' => $community);
    }


}




