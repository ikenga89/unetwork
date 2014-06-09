<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\SectionType;
use Unetwork\AdminBundle\Entity\Section;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SectionController extends Controller
{

    /**
     * @Route("/admin/section", name="admin_section")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $sections = $this->getDoctrine()
                            ->getRepository('UnetworkAdminBundle:Section')
                            ->findBy(Array(),Array('name'=>'ASC'));

        return array(
            "sections" => $sections,
        );
    }





    /**
     * @Route("/admin/section/create", name="admin_section_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $section = new Section();
        $form = $this->createForm(new SectionType(), $section);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_section'));
        };
        return array(
            "form"=>$form->createView()
        );
    }


    /**
     * @Route("/admin/section/edit/{id}", name="admin_section_edit")
     * @Template()
     */
    public function editAction(Request $request ,$id)
    {   
        $section = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Section')
        ->find($id);

        $form = $this->createForm(new SectionType(), $section);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_section'));
        }

        return array(
            "form" => $form->createView(),
        );


        //return array('community' => $community);
    }




    /**
     * @Route("/admin/section/delete/{id}", name="admin_section_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $section = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->find($id);

        $em->remove($section);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "La section a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('admin_section'));
    }




    /**
     * @Route("/admin/community/update", name="admin_community_update")
     * @Template()
     */
    /*
    public function updateAction()
    {   
        $bdd = $this->get('database_connection'); 
        $count = 0;

        if (isset( $_POST["post_community_name"]) && !empty($_POST["post_community_name"]) &&
            isset( $_POST["post_community_id"])   && !empty($_POST["post_community_id"]) &&
            isset( $_POST["post_community_alias"]) && !empty($_POST["post_community_alias"]) ){

            $community_name = $_POST["post_community_name"];
            $community_id = $_POST["post_community_id"];
            $community_alias = $_POST["post_community_alias"];

            $count = $bdd->executeUpdate('UPDATE community SET name = "'.$community_name.'", alias = "'.$community_alias.'", updated = NOW() WHERE id = '.$community_id.' ');

        }

        return new Response($count);
    }
    */


    
}