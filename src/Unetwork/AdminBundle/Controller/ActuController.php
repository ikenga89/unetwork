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
         $actualities = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->findBy(Array(),Array('updated'=>'DESC'));
        return array("actualities"=>$actualities);
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
    public function editAction($id)
    {   
         $actuality = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->find($id);
        return array("actuality"=>$actuality);
    }
    /**
     * @Route("/admin/actu/delete/{id}", name="admin_actu_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $actuality = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Actuality')
        ->find($id);

        $em->remove($actuality);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "L'actualité a bien été supprimée"
        );


        return $this->redirect($this->generateUrl('admin_actu'));
    }
}
