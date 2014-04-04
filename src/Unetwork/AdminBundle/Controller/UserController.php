<?php

namespace Unetwork\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\AdminBundle\Form\UserType;
use Unetwork\AdminBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/admin/user", name="admin_user")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/admin/user/create", name="admin_user_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $user = new User;
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $encoder = $this
            ->get('security.encoder_factory')
            ->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user'));
        }

        return array('form'=>$form->createView());
    }
    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit")
     * @Template()
     */
    public function editAction()
    {
        return array();
    }
    /**
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array();
    }
}
