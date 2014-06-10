<?php

namespace Unetwork\PublicBundle\Controller;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unetwork\PublicBundle\Form\InscriptionType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="public_home")
     * @Template()
     */
    public function homeAction(Request $request)
    {
		$form = $this->createForm(new InscriptionType());

		$form->handleRequest($request);

		if($form->isValid()){

			$data = $form->getData();

            $message = \Swift_Message::newInstance()
            ->setSubject('Demande d\'inscription')
            ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
            ->setTo('maxime.sifflet@gmail.com')
            ->setBody($this->renderView('UnetworkAdminBundle:Mail:register_request.txt.twig', array('data' => $data)));
            $this->get('mailer')->send($message);


            $this->get('session')->getFlashBag()->add(
                'notice',
                'Votre demande d\'inscription à bien été envoyé !'
            );

			return $this->redirect($this->generateUrl('public_home'));
		}

        try {
            $facebook = new \Facebook(array(
              'appId'  => '414516295351453',
              'secret' => 'd7e480e45243e668ee39e6c868af52db',
            ));
            $facebook_posts = $facebook->api('/110864882309437/posts');
        } catch (Exception $e) {
            $facebook_posts = array();
        }


        $twitterClient = $this->container->get('guzzle.twitter.client');
        $tweets = $twitterClient->get('statuses/user_timeline.json');
        $tweets->getQuery()->set('count', 5);
        $tweets->getQuery()->set('screen_name', 'SciencesULyon');
        $response = $tweets->send();

        $tweets = json_decode($response->getBody());

        $all_tweet = array();
        foreach ($tweets as $tweet) {
            $text_tweet = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" TARGET=_BLANK >$1</a>', $tweet->text);
            $all_tweet[] = array('text' => $text_tweet, 'created_at' => $tweet->created_at);
        }


        return array(
            'posts' => $facebook_posts['data'],
            'tweets' => $all_tweet,
            'form' => $form->createView(),
        );
    }


    /**
     * @Route("/register/{register_token}", name="public_register")
     * @Template()
     */
    public function registerAction(Request $request, $register_token = NULL){

        $user = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->findOneByRegisterToken($register_token);

        if(empty($user)){

            return $this->render('UnetworkPublicBundle:Default:tokenwrong.html.twig');

        }else{

            $defaultData = array();
            $form = $this->createFormBuilder($defaultData)
                ->setAction($this->generateUrl('public_register', array('register_token' => $register_token)))
                ->add('password', 'repeated', array(
                    'label' => 'Choisissez un mot de passe :',
                    'type' => 'password',
                    'invalid_message' => 'Les mots de passe doivent correspondre',
                    'options' => array('required' => true),
                    'first_options'  => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Mot de passe (validation)'),
                ))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isValid()) {

                $user->setPassword($form['password']->getData());

                $encoder = $this
                ->get('security.encoder_factory')
                ->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);

                $user->setIsActive(true);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Connexion
                $token = new UsernamePasswordToken($user, $user->getPassword(), 'admin_area', $user->getRoles());
                $this->get('security.context')->setToken($token);
                $this->get('session')->set('_security_main',serialize($token));

                return $this->redirect($this->generateUrl('app_index'));

            }

            return array(
                'form'=>$form->createView(),
            );

        }

    }




    /**
     * @Route("/thanks", name="public_thanks")
     * @Template()
     */
    public function thanksAction()
    {
        return array();
    }

}
