<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form;

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
        ->findBy(Array(),Array('name'=>'ASC'));

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
        $em = $this->getDoctrine()->getManager();

        $community = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->find($id);

        $em->remove($community);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "La communauté a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('admin_community'));
    }


}




