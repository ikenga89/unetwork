<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Unetwork\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Unetwork\AdminBundle\Entity\User;
use Unetwork\AdminBundle\Entity\Community;
use Unetwork\AdminBundle\Entity\Actuality;
use Unetwork\AdminBundle\Entity\Comment;
use Unetwork\AdminBundle\Entity\Cv;
use Unetwork\AdminBundle\Entity\Experience;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {


        /*
        *   Community
        */
        $community = new Community();
        $community->setName('Informatique');


        /*
        *   User
        */
        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.fr');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userAdmin);
        $password = $encoder->encodePassword('test', $userAdmin->getSalt());
        $userAdmin->setPassword($password);
        $userAdmin->setNom('Nom');
        $userAdmin->setPrenom('Prenom');
        $userUser->setCommunity($community);
        $userAdmin->setRoles('ROLE_ADMIN');

        $userUser = new User();
        $userUser->setEmail('user@user.fr');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userUser);
        $password = $encoder->encodePassword('test', $userUser->getSalt());
        $userUser->setPassword($password);
        $userUser->setNom('Nom2');
        $userUser->setPrenom('Prenom2');
        $userUser->setCommunity($community);
        $userUser->setRoles('ROLE_USER');


        /*
        *   Cv
        */
        $cv = new Cv();
        $cv->setCountry('country1');
        $cv->setWebsite('website1');
        $cv->setDescription('description1');
        $cv->setFormation('formation1');
        $cv->setUser($userUser);


        /*
        *   Experience
        */
        $experience = new Experience();
        $experience->setTypejob('typejob1');
        $experience->setDescription('description1');
        $experience->setBegin(new \DateTime);
        $experience->setEnd(new \DateTime);
        $experience->setCv($cv);


        /*
        *   Actuality
        */
        $actuality = new Actuality();
        $actuality->setDescription('description1');
        $actuality->setCreated(new \DateTime);
        $actuality->setUpdated(new \DateTime);
        $actuality->setCommunity($community);



        /*
        *   Comment
        */
        $comment = new Comment();
        $comment->setDate(new \DateTime);
        $comment->setContent('comment1');
        $comment->setActualitys($actuality);



        $manager->persist($community);
        $manager->persist($userAdmin);
        $manager->persist($userUser);
        $manager->persist($cv);
        $manager->persist($experience);
        $manager->persist($actuality);
        $manager->persist($comment);


        $manager->flush();
    }
}