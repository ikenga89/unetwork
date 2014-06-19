<?php

namespace Unetwork\AppBundle\Controller\Parameter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\CvType;
use Unetwork\AdminBundle\Entity\Cv;
use Symfony\Component\HttpFoundation\Request;

class CvController extends Controller
{
    /**
     * @Route("/app/parameter/cv", name="app_param_cv")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return array("user"=>$user);
    }

    /**
     * @Route("/app/parameter/cv/edit", name="app_param_cv_edit")
     * @Template()
     */
    public function editAction(Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $cv = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:Cv')
        ->findOneByUser($user);
    
        $form = $this->createForm(new CvType(), $cv);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'cv',
                "Les informations du cv ont bien été modifiées"
            );

            return $this->redirect($this->generateUrl('app_param_cv'));
        }

        return array(
            "form" => $form->createView(),
            'user' => $user,
        );
    }

}
