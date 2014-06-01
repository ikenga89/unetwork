<?php

namespace Unetwork\AppBundle\Controller\Parameter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AppBundle\Form\ProfilType;
use Unetwork\AdminBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{
    /**
     * @Route("/app/parameter/profil", name="app_param_profil")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        return array("user"=>$user);
    }

    /**
     * @Route("/app/parameter/profil/edit", name="app_param_profil_edit")
     * @Template()
     */
    public function editAction(Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();
    
        $form = $this->createForm(new ProfilType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $user->preUpload();
        $user->preUploadCouv();
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('app_param_profil'));
        }

        return array(
            'user' => $user,
            "form"=>$form->createView()
        );
    }
}
