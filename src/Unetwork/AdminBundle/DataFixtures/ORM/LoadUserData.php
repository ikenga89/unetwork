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
use Unetwork\AdminBundle\Entity\ExperienceType;
use Unetwork\AdminBundle\Entity\Experience;
use Unetwork\AdminBundle\Entity\Competence;
use Unetwork\AdminBundle\Entity\Hobby;
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
        $community->setCreated(new \DateTime);
        $community->setUpdated(new \DateTime);


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
        $userAdmin->setNom('NomAdmin1');
        $userAdmin->setPrenom('PrenomAdmin1');
        $userAdmin->setVille('VilleAdmin1');
        $userAdmin->setTel('TelAdmin1');
        $userAdmin->setDateNais(new \DateTime('1990-01-01'));
        $userAdmin->setLinkedin('http://linkedin.com');
        $userAdmin->setViadeo('http://viadeo.com');
        $userAdmin->setTwitter('http://twitter.com');
        $userAdmin->setUrl('http://url.com');
        $userAdmin->setCommunity($community);
        $userAdmin->setRoles('ROLE_ADMIN');
        $userAdmin->setCreated(new \DateTime);
        $userAdmin->setUpdated(new \DateTime);

        $userUser = new User();
        $userUser->setEmail('user@user.fr');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userUser);
        $password = $encoder->encodePassword('test', $userUser->getSalt());
        $userUser->setPassword($password);
        $userUser->setNom('NomUser1');
        $userUser->setPrenom('PrenomUser1');
        $userUser->setVille('VilleUser1');
        $userUser->setTel('TelUser1');
        $userUser->setDateNais(new \DateTime('1990-01-01'));
        $userUser->setLinkedin('http://linkedin.com');
        $userUser->setViadeo('http://viadeo.com');
        $userUser->setTwitter('http://twitter.com');
        $userUser->setUrl('http://url.com');
        $userUser->setCommunity($community);
        $userUser->setRoles('ROLE_USER');
        $userUser->setCreated(new \DateTime);
        $userUser->setUpdated(new \DateTime);

        /*
        *   Cv
        */
        $cv = new Cv();
        $cv->setPresentation('PresentationCv1');
        $cv->setUser($userUser);
        $cv->setCreated(new \DateTime);
        $cv->setUpdated(new \DateTime);

        /*
        *   ExperienceType
        */
        $experience_type1 = new ExperienceType();
        $experience_type1->setLibelle('libelle1');

        /*
        *   Experience
        */
        $experience = new Experience();
        $experience->setCv($cv);
        $experience->setType($experience_type1);
        $experience->setName('name1');
        $experience->setDescription('description1');
        $experience->setBegin(new \DateTime);
        $experience->setEnd(new \DateTime);
        $experience->setCreated(new \DateTime);
        $experience->setUpdated(new \DateTime);

        /*
        *   Competence
        */
        $competence = new Competence();
        $competence->setCv($cv);
        $competence->setName('name1');
        $competence->setNote(3);
        $competence->setCreated(new \DateTime);
        $competence->setUpdated(new \DateTime);

        /*
        *   Hobby
        */
        $hobby = new Hobby();
        $hobby->setCv($cv);
        $hobby->setName('name1');
        $hobby->setCreated(new \DateTime);
        $hobby->setUpdated(new \DateTime);

        /*
        *   Experience
        */
        $experience = new Experience();
        $experience->setCv($cv);
        $experience->setType($experience_type1);
        $experience->setName('name1');
        $experience->setDescription('description1');
        $experience->setBegin(new \DateTime);
        $experience->setEnd(new \DateTime);
        $experience->setCreated(new \DateTime);
        $experience->setUpdated(new \DateTime);

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
        $comment->setCreated(new \DateTime);
        $comment->setUpdated(new \DateTime);



        $manager->persist($community);
        $manager->persist($userAdmin);
        $manager->persist($userUser);
        $manager->persist($cv);
        $manager->persist($experience_type1);
        $manager->persist($experience);
        $manager->persist($competence);
        $manager->persist($hobby);
        $manager->persist($actuality);
        $manager->persist($comment);


        $manager->flush();
    }
}