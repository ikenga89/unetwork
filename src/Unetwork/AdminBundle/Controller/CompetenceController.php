<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Entity\Competence;
use Symfony\Component\HttpFoundation\Request;

class CompetenceController extends Controller
{

    /**
     * @Route("/admin/competence", name="admin_competence")
     * @Template()
     */
    public function indexAction()
    {

        $competences = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Competence')
        ->findBy(Array(),Array('updated'=>'DESC'));

        return array( "competences" => $competences );
    
    }


    /**
     * @Route("/admin/competence/delete/{id}", name="admin_competence_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $competence = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Competence')
        ->find($id);

        $em->remove($competence);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "La competence a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('admin_competence'));
    }


}




