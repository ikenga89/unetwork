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
     * @Route("/app/parameter/profil/edit/{type}", name="app_param_profil_edit")
     * @Template()
     */
    public function editAction(Request $request, $type)
    {   
        $user = $this->get('security.context')->getToken()->getUser();
    
        $form = $this->createForm(new ProfilType($type), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if($type == 'password'){

                $encoder = $this
                    ->get('security.encoder_factory')
                    ->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);

            }

            $em = $this->getDoctrine()->getManager();
            $user->preUpload();
            $user->preUploadCouv();
            $em->persist($user);
            $em->flush();

            if($type == 'profil'){

                return $this->redirect($this->generateUrl('app_param_profil'));

            }else{

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Votre mot de passe à bien été modifié !'
                );

                return $this->redirect($this->generateUrl('app_param_profil_edit', array('type'=>'password')));

            }

        }


        if($type == 'profil'){

            return array(
                'user' => $user,
                "form"=>$form->createView()
            );

        }else{

            return $this->render('UnetworkAppBundle:Parameter:Profil/edit_password.html.twig', array(
                'form' => $form->createView(),
            ));

        }
        
    }
    
}
