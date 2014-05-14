<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Entity\Experience;
use Symfony\Component\HttpFoundation\Request;

class ExperienceController extends Controller
{

    /**
     * @Route("/admin/experience", name="admin_experience")
     * @Template()
     */
    public function indexAction()
    {

        $experiences = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Experience')
        ->findBy(Array(),Array('updated'=>'DESC'));

        return array( "experiences" => $experiences );
    
    }


    /**
     * @Route("/admin/experience/delete/{id}", name="admin_experience_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $experience = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Experience')
        ->find($id);

        $em->remove($experience);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "L&rsquo;experience a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('admin_experience'));
    }


}




