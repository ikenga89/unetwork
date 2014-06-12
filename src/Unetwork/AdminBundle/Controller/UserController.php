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
        $users = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->findBy(Array(),Array('nom'=>'ASC'));
        return array("users"=>$users);
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

            $data = $form->getData();

            $token = uniqid(true);

            $uri = $this->get('router')->generate('public_home');
            $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $link = $baseurl.$uri.'register/'.$token;

            $user->setRegisterToken($token);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $message = \Swift_Message::newInstance()
            ->setSubject('Inscription')
            ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
            ->setTo($form['email']->getData())
            ->setBody($this->renderView('UnetworkAdminBundle:Mail:register.html.twig', array(
                'data' => $data,
                'link' => $link,
            )));
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('admin_user'));
        }

        return array('form'=>$form->createView());
    }

    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $user = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->find($id);

        $form = $this->createForm(new UserType('edit'), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user->preUpload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user'));
        }

        return array('form'=>$form->createView());
    }

    /**
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     * @Template()
     */
    public function deleteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->find($id);

        $em->remove($user);
        $em->flush();

       $this->get('session')->getFlashBag()->add(
            'notice',
            "L'utilisateur a bien été supprimé"
        );


        return $this->redirect($this->generateUrl('admin_user'));
    }
}
