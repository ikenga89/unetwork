<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\CommunityType;
use Unetwork\AdminBundle\Entity\Community;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CommunityController extends Controller
{

    /**
     * @Route("/admin/community", name="admin_community")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /*
        $community = new Community();
        $form = $this->createForm(new CommunityType(), $community);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($community);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_community'));
        }
        */


        $communities = $this->getDoctrine()
                            ->getRepository('UnetworkAdminBundle:Community')
                            ->findBy(Array(),Array('name'=>'ASC'));

        return array(
            "communities" => $communities,
        );
    }





    /**
     * @Route("/admin/community/create", name="admin_community_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $community = new Community();
        $form = $this->createForm(new CommunityType(), $community);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($community);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'notice',
            "La communauté a bien été crée"
            );

            return $this->redirect($this->generateUrl('admin_community'));
        };

        return array(
            "form"=>$form->createView(),
        );
    }


    /**
     * @Route("/admin/community/edit/{id}", name="admin_community_edit")
     * @Template()
     */
    public function editAction(Request $request ,$id)
    {   
        $community = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Community')
        ->find($id);

        $form = $this->createForm(new CommunityType(), $community);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $community->preUpload();
            $em->persist($community);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_community'));
        }

        return array(
            "form" => $form->createView(),
        );
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




    /**
     * @Route("/admin/community/update", name="admin_community_update")
     * @Template()
     */
    public function updateAction()
    {   
        $bdd = $this->get('database_connection'); 
        $name_and_alias_insert = 0;
        $image_insert = 0;
        $new_image_link = "";

        if (isset( $_POST["post_community_name"]) && !empty($_POST["post_community_name"]) &&
            isset( $_POST["post_community_id"])   && !empty($_POST["post_community_id"]) &&
            isset( $_POST["post_community_alias"]) && !empty($_POST["post_community_alias"]) ){

            $community_name = $_POST["post_community_name"];
            $community_id = $_POST["post_community_id"];
            $community_alias = $_POST["post_community_alias"];

            $name_and_alias_insert = $bdd->executeUpdate('UPDATE community SET name = "'.$community_name.'", alias = "'.$community_alias.'", updated = NOW() WHERE id = '.$community_id.' ');

            if ( isset( $_FILES["post_community_image"]) && !empty($_FILES["post_community_image"]) ){
                if ( ( $_FILES["post_community_image"]["error"] == 0 )
                    && ($_FILES["post_community_image"]["type"] == "image/gif")
                    || ($_FILES["post_community_image"]["type"] == "image/jpeg")
                    || ($_FILES["post_community_image"]["type"] == "image/jpg")
                    || ($_FILES["post_community_image"]["type"] == "image/pjpeg")
                    || ($_FILES["post_community_image"]["type"] == "image/x-png")
                    || ($_FILES["post_community_image"]["type"] == "image/png")
                    && ($_FILES["post_community_image"]["size"] < 1000000) ){ // 1 mo = 1000000 octet

                    $community_image = $_FILES["post_community_image"];
                    $extention = pathinfo($community_image["name"], PATHINFO_EXTENSION);
                    $new_image_name = sha1(uniqid(mt_rand(), true)).".".$extention;

                    if(!is_dir( "Admin/communities/".$community_id."/" )){
                        mkdir( "Admin/communities/".$community_id."/" );
                    }
                    if(!is_dir( "Admin/communities/".$community_id."/image_couv/" )){
                        mkdir( "Admin/communities/".$community_id."/image_couv/" );
                    }

                    move_uploaded_file( $community_image["tmp_name"], "Admin/communities/".$community_id."/image_couv/".$new_image_name );

                    if ( file_exists( "Admin/communities/".$community_id."/image_couv/".$new_image_name ) ) {
                        $image_insert = $bdd->executeUpdate('UPDATE community SET path = "'.$new_image_name.'" WHERE id = '.$community_id.' ');

                        $new_image_link = "/Admin/communities/".$community_id."/image_couv/".$new_image_name;
                    }
                }
            }
        }

        $insertion = array("name_and_alias_insert" => $name_and_alias_insert, "image_insert" => $image_insert, "new_image_link" => $new_image_link);

        return new Response( json_encode($insertion) );
    }
    

    
}