<?php

namespace Unetwork\AppBundle\Controller\Parameter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\ExperienceType;
use Unetwork\AdminBundle\Entity\Experience;
use Symfony\Component\HttpFoundation\Request;

class ExperienceController extends Controller
{
    /**
     * @Route("/app/parameter/experiences", name="app_param_experiences")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return array("user"=>$user);
    }

    /**
     * @Route("/app/parameter/experience/create", name="app_param_experience_create")
     * @Template()
     */
    public function createAction(Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $experience = new Experience();
        $form = $this->createForm(new ExperienceType(), $experience);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $experience->setCv($user->getCv());
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_experiences'));
        }

        return array("form"=>$form->createView());
    }

    /**
     * @Route("/app/parameter/experience/edit/{id}", name="app_param_experience_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {   
        $experience = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Experience')
        ->find($id);
    
        $form = $this->createForm(new ExperienceType(), $experience);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_experiences'));
        }

        return array("form"=>$form->createView());
    }

    /**
     * @Route("/app/parameter/experience/delete/{id}", name="app_param_experience_delete")
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
            "L'experience a bien été supprimée"
        );


        return $this->redirect($this->generateUrl('app_param_experiences'));
    }
}
