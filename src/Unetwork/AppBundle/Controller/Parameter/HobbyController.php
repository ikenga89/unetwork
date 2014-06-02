<?php

namespace Unetwork\AppBundle\Controller\Parameter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\HobbyType;
use Unetwork\AdminBundle\Entity\Hobby;
use Symfony\Component\HttpFoundation\Request;

class HobbyController extends Controller
{
    /**
     * @Route("/app/parameter/hobbies", name="app_param_hobbies")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return array("user"=>$user);
    }

    /**
     * @Route("/app/parameter/hobby/create", name="app_param_hobby_create")
     * @Template()
     */
    public function createAction(Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $hobby = new Hobby();
        $form = $this->createForm(new HobbyType(), $hobby);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $hobby->setCv($user->getCv());
            $em = $this->getDoctrine()->getManager();
            $em->persist($hobby);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_hobbies'));
        }

        return array(
            'user' => $user,
            "form"=>$form->createView(),
        );
    }

    /**
     * @Route("/app/parameter/hobby/edit/{id}", name="app_param_hobby_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $hobby = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Hobby')
        ->find($id);
    
        $form = $this->createForm(new HobbyType(), $hobby);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hobby);
            $em->flush();

            return $this->redirect($this->generateUrl('app_param_hobbies'));
        }

        return array(
            "form" => $form->createView(),
            'user' => $user,
        );
    }

    /**
     * @Route("/app/parameter/hobby/delete/{id}", name="app_param_hobby_delete")
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
            "Le hobby a bien été supprimé"
        );


        return $this->redirect($this->generateUrl('app_param_hobbies'));
    }
}
