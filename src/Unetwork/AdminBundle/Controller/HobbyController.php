<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Entity\Hobby;
use Symfony\Component\HttpFoundation\Request;

class HobbyController extends Controller
{

    /**
     * @Route("/admin/hobby", name="admin_hobby")
     * @Template()
     */
    public function indexAction()
    {

        $hobbies = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Hobby')
        ->findBy(Array(),Array('updated'=>'DESC'));

        return array( "hobbies" => $hobbies );
    
    }


    /**
     * @Route("/admin/hobby/delete/{id}", name="admin_hobby_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $hobby = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Hobby')
        ->find($id);

        $em->remove($hobby);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "L&rsquo;hobby a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('admin_hobby'));
    }


}




