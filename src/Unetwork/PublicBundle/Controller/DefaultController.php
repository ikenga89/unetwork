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

                $encoder = $this
                ->get('security.encoder_factory')
                ->getEncoder($user);
                $password = $encoder->encodePassword($form['password']->getData(), $user->getSalt());
                $user->setPassword($password);

                $user->setIsActive(true);

                $user->setRegisterToken(null);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                ->setSubject('Inscription terminé')
                ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
                ->setTo($user->getEmail())
                ->setBody($this->renderView('UnetworkAdminBundle:Mail:register_end.txt.twig'));
                $this->get('mailer')->send($message);

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
     * @Route("/repassword/email", name="public_repassword_email")
     * @Template()
     */
    public function repassword_emailAction(Request $request)
    {

        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
            ->setAction($this->generateUrl('public_repassword_email'))
            ->add('email', 'email', array(
                'label' => 'Veuillez saisir votre identifiant :',
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->getDoctrine()
                ->getRepository('UnetworkAdminBundle:User')
                ->findOneByEmail($form['email']->getData());

            if(empty($user)){

                return $this->render('UnetworkPublicBundle:Default:emailwrong.html.twig');

            }else{

                $data = $form->getData();

                $token = uniqid(true);

                $currentDate = new \DateTime();
                $tokenDate = $currentDate->modify('+3 day');

                $uri = $this->get('router')->generate('public_home');
                $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
                $link = $baseurl.$uri.'repassword/'.$token;

                $user->setRepasswordToken($token);

                $user->setRepasswordTokenDate($tokenDate);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                ->setSubject('Oubli de mot de passe')
                ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
                ->setTo($user->getEmail())
                ->setBody($this->renderView('UnetworkAdminBundle:Mail:repassword.txt.twig', array(
                    'data' => $data,
                    'link' => $link,
                )));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Un email vous à été envoyé pour récuperer votre mot de passe !'
                );

                return $this->redirect($this->generateUrl('public_home'));

            }

        }

        return array(
            'form' => $form->createView(),
        );
    }


    /**
     * @Route("/repassword/{repassword_token}", name="public_repassword")
     * @Template()
     */
    public function repasswordAction(Request $request, $repassword_token = NULL)
    {
        $user = $this->getDoctrine()
        ->getRepository('UnetworkAdminBundle:User')
        ->findOneByRepasswordToken($repassword_token);

        if(empty($user)){

            return $this->render('UnetworkPublicBundle:Default:tokenwrong.html.twig');

        }else{

            $currentDate = new \Datetime();

            if($currentDate > $user->getRepasswordTokenDate()){

                return $this->render('UnetworkPublicBundle:Default:tokenwrong.html.twig');

            }else{

                $defaultData = array();
                    $form = $this->createFormBuilder($defaultData)
                        ->setAction($this->generateUrl('public_repassword', array('repassword_token' => $repassword_token)))
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

                    $encoder = $this
                    ->get('security.encoder_factory')
                    ->getEncoder($user);
                    $password = $encoder->encodePassword($form['password']->getData(), $user->getSalt());
                    $user->setPassword($password);

                    $user->setRepasswordToken(null);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    $message = \Swift_Message::newInstance()
                    ->setSubject('Modification de mot de passe')
                    ->setFrom(array('unetwork89@gmail.com' => 'Unetwork'))
                    ->setTo($user->getEmail())
                    ->setBody($this->renderView('UnetworkAdminBundle:Mail:repassword_end.txt.twig'));
                    $this->get('mailer')->send($message);

                    // Connexion
                    $token = new UsernamePasswordToken($user, $user->getPassword(), 'admin_area', $user->getRoles());
                    $this->get('security.context')->setToken($token);
                    $this->get('session')->set('_security_main',serialize($token));

                    return $this->redirect($this->generateUrl('app_index'));

                }

                return array(
                    'form' => $form->createView(),
                );

            }

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
