<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\ActuType;
use Unetwork\AdminBundle\Entity\Actuality;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/admin/actu/create", name="admin_actu_create")
     * @Template()
     */
    public function createAction(Request $request)
    {   

        $actu = new Actuality();
        $form = $this->createForm(new ActuType(), $actu);
        $form->handleRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($actu);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_actu'));
        }

        return array("form"=>$form->createView());
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
