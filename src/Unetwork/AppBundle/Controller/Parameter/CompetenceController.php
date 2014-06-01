<?php

namespace Unetwork\AppBundle\Controller\Parameter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\CompetenceType;
use Unetwork\AdminBundle\Entity\Competence;
use Symfony\Component\HttpFoundation\Request;

class CompetenceController extends Controller
{
    /**
     * @Route("/app/parameter/competences", name="app_param_competences")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return array("user"=>$user);
    }

    /**
     * @Route("/app/parameter/competence/create", name="app_param_competence_create")
     * @Template()
     */
    public function createAction(Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $competence = new Competence();
        $form = $this->createForm(new CompetenceType(), $competence);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $competence->setCv($user->getCv());
            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_competences'));
        }

        return array(
            'user' => $user,
            "form"=>$form->createView(),
        );
    }

    /**
     * @Route("/app/parameter/competence/edit/{id}", name="app_param_competence_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $competence = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Competence')
        ->find($id);
    
        $form = $this->createForm(new CompetenceType(), $competence);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_competences'));
        }

        return array(
            "form" => $form->createView(),
            'user' => $user,
        );
    }

    /**
     * @Route("/app/parameter/competence/delete/{id}", name="app_param_competence_delete")
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
            "La compétence a bien été supprimée"
        );


        return $this->redirect($this->generateUrl('app_param_competences'));
    }
}
