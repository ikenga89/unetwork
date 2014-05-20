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
        $lorem = 'Lorem ipsum Cillum labore do labore proident Duis aute id consectetur id veniam magna adipisicing voluptate laboris esse incididunt voluptate id nisi consectetur mollit deserunt anim dolor irure consequat cupidatat aliquip veniam in dolor proident quis ad Duis nisi eiusmod Duis incididunt proident consectetur do dolore laboris deserunt tempor eu consectetur est eu eu consequat eu ullamco ullamco dolore dolor mollit in sed anim reprehenderit adipisicing dolor proident Excepteur Ut amet Excepteur deserunt anim minim eiusmod in laboris fugiat laborum aliquip commodo aute anim consequat amet in magna velit fugiat deserunt Ut non Ut ex magna proident cillum consectetur voluptate do Excepteur qui cillum ullamco Ut dolor adipisicing veniam dolore nisi veniam esse sunt elit dolore cupidatat dolore ad enim aute aliqua voluptate cillum aute sunt mollit irure non cillum minim dolor veniam magna laborum quis ut ea aliquip enim pariatur irure magna nisi et anim adipisicing laboris irure dolor non.';

        /*
        *   Community
        */
        $community = new Community();
        $community->setName('Concepteur Réalisateur Web');
        $community->setAlias('crw');
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
        $cvAdmin = new Cv();
        $cvAdmin->setPresentation('PresentationCv1');
        $cvAdmin->setJobname('Développeur web');
        $cvAdmin->setUser($userAdmin);
        $cvAdmin->setCreated(new \DateTime);
        $cvAdmin->setUpdated(new \DateTime);

        $cvUser = new Cv();
        $cvUser->setPresentation('PresentationCv1');
        $cvUser->setJobname('Développeur web');
        $cvUser->setUser($userUser);
        $cvUser->setCreated(new \DateTime);
        $cvUser->setUpdated(new \DateTime);

        /*
        *   ExperienceType
        */
        $experience_type1 = new ExperienceType();
        $experience_type1->setLibelle('fa fa-suitcase');

        $experience_type2 = new ExperienceType();
        $experience_type2->setLibelle('fa fa-trophy');

        /*
        *   Experience
        */
        $experience = new Experience();
        $experience->setCv($cvUser);
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
        $competence->setCv($cvUser);
        $competence->setName('name1');
        $competence->setNote(3);
        $competence->setCreated(new \DateTime);
        $competence->setUpdated(new \DateTime);

        $competence2 = new Competence();
        $competence2->setCv($cvUser);
        $competence2->setName('name2');
        $competence2->setNote(1);
        $competence2->setCreated(new \DateTime);
        $competence2->setUpdated(new \DateTime);

        $competence3 = new Competence();
        $competence3->setCv($cvUser);
        $competence3->setName('name3');
        $competence3->setNote(4);
        $competence3->setCreated(new \DateTime);
        $competence3->setUpdated(new \DateTime);

        /*
        *   Hobby
        */
        $hobby = new Hobby();
        $hobby->setCv($cvUser);
        $hobby->setName('name1');
        $hobby->setCreated(new \DateTime);
        $hobby->setUpdated(new \DateTime);

        $hobby2 = new Hobby();
        $hobby2->setCv($cvUser);
        $hobby2->setName('name2');
        $hobby2->setCreated(new \DateTime);
        $hobby2->setUpdated(new \DateTime);

        $hobby3 = new Hobby();
        $hobby3->setCv($cvUser);
        $hobby3->setName('name3');
        $hobby3->setCreated(new \DateTime);
        $hobby3->setUpdated(new \DateTime);

        $hobby4 = new Hobby();
        $hobby4->setCv($cvUser);
        $hobby4->setName('name4');
        $hobby4->setCreated(new \DateTime);
        $hobby4->setUpdated(new \DateTime);

        $hobby5 = new Hobby();
        $hobby5->setCv($cvUser);
        $hobby5->setName('name5');
        $hobby5->setCreated(new \DateTime);
        $hobby5->setUpdated(new \DateTime);

        $hobby6 = new Hobby();
        $hobby6->setCv($cvUser);
        $hobby6->setName('name6');
        $hobby6->setCreated(new \DateTime);
        $hobby6->setUpdated(new \DateTime);

        $hobby7 = new Hobby();
        $hobby7->setCv($cvUser);
        $hobby7->setName('name7');
        $hobby7->setCreated(new \DateTime);
        $hobby7->setUpdated(new \DateTime);

        $hobby8 = new Hobby();
        $hobby8->setCv($cvUser);
        $hobby8->setName('name7');
        $hobby8->setCreated(new \DateTime);
        $hobby8->setUpdated(new \DateTime);

        /*
        *   Experience
        */
        $experienceAdmin = new Experience();
        $experienceAdmin->setCv($cvAdmin);
        $experienceAdmin->setType($experience_type1);
        $experienceAdmin->setName('experienceAdmin1');
        $experienceAdmin->setDescription($lorem);
        $experienceAdmin->setBegin(new \DateTime('2011-01-01'));
        $experienceAdmin->setEnd(new \DateTime('2012-02-01'));
        $experienceAdmin->setCreated(new \DateTime);
        $experienceAdmin->setUpdated(new \DateTime);

        $experienceAdmin2 = new Experience();
        $experienceAdmin2->setCv($cvAdmin);
        $experienceAdmin2->setType($experience_type2);
        $experienceAdmin2->setName('experienceAdmin2');
        $experienceAdmin2->setDescription($lorem);
        $experienceAdmin2->setBegin(new \DateTime('2012-03-01'));
        $experienceAdmin2->setEnd(new \DateTime('2013-05-01'));
        $experienceAdmin2->setCreated(new \DateTime);
        $experienceAdmin2->setUpdated(new \DateTime);

        $experienceAdmin3 = new Experience();
        $experienceAdmin3->setCv($cvAdmin);
        $experienceAdmin3->setType($experience_type1);
        $experienceAdmin3->setName('experienceAdmin3');
        $experienceAdmin3->setDescription($lorem);
        $experienceAdmin3->setBegin(new \DateTime('2013-06-01'));
        $experienceAdmin3->setEnd(new \DateTime('2014-02-01'));
        $experienceAdmin3->setCreated(new \DateTime);
        $experienceAdmin3->setUpdated(new \DateTime);


        $experienceUser = new Experience();
        $experienceUser->setCv($cvUser);
        $experienceUser->setType($experience_type1);
        $experienceUser->setName('experienceUser1');
        $experienceUser->setDescription($lorem);
        $experienceUser->setBegin(new \DateTime('2011-01-01'));
        $experienceUser->setEnd(new \DateTime('2012-02-01'));
        $experienceUser->setCreated(new \DateTime);
        $experienceUser->setUpdated(new \DateTime);

        $experienceUser2 = new Experience();
        $experienceUser2->setCv($cvUser);
        $experienceUser2->setType($experience_type1);
        $experienceUser2->setName('experienceUser2');
        $experienceUser2->setDescription($lorem);
        $experienceUser2->setBegin(new \DateTime('2012-03-01'));
        $experienceUser2->setEnd(new \DateTime('2013-05-01'));
        $experienceUser2->setCreated(new \DateTime);
        $experienceUser2->setUpdated(new \DateTime);

        $experienceUser3 = new Experience();
        $experienceUser3->setCv($cvUser);
        $experienceUser3->setType($experience_type1);
        $experienceUser3->setName('experienceUser2');
        $experienceUser3->setDescription($lorem);
        $experienceUser3->setBegin(new \DateTime('2013-06-01'));
        $experienceUser3->setEnd(new \DateTime('2014-02-01'));
        $experienceUser3->setCreated(new \DateTime);
        $experienceUser3->setUpdated(new \DateTime);

        /*
        *   Actuality
        */
        $actuality = new Actuality();
        $actuality->setDescription('description1');
        $actuality->setCreated(new \DateTime);
        $actuality->setUpdated(new \DateTime);
        $actuality->setCommunity($community);

        $actuality2 = new Actuality();
        $actuality2->setDescription('description2');
        $actuality2->setCreated(new \DateTime);
        $actuality2->setUpdated(new \DateTime);
        $actuality2->setCommunity($community);

        $actuality3 = new Actuality();
        $actuality3->setDescription('description3');
        $actuality3->setCreated(new \DateTime);
        $actuality3->setUpdated(new \DateTime);
        $actuality3->setCommunity($community);

        $actuality4 = new Actuality();
        $actuality4->setDescription('description4');
        $actuality4->setCreated(new \DateTime);
        $actuality4->setUpdated(new \DateTime);
        $actuality4->setCommunity($community);

        $actuality5 = new Actuality();
        $actuality5->setDescription('description5');
        $actuality5->setCreated(new \DateTime);
        $actuality5->setUpdated(new \DateTime);
        $actuality5->setCommunity($community);

        $actuality6 = new Actuality();
        $actuality6->setDescription('description6');
        $actuality6->setCreated(new \DateTime);
        $actuality6->setUpdated(new \DateTime);
        $actuality6->setCommunity($community);

        /*
        *   Comment
        */
        $comment = new Comment();
        $comment->setDate(new \DateTime);
        $comment->setContent('comment1');
        $comment->setActualitys($actuality);
        $comment->setCreated(new \DateTime);
        $comment->setUpdated(new \DateTime);

        $comment2 = new Comment();
        $comment2->setDate(new \DateTime);
        $comment2->setContent('comment2');
        $comment2->setActualitys($actuality);
        $comment2->setCreated(new \DateTime);
        $comment2->setUpdated(new \DateTime);

        $comment3 = new Comment();
        $comment3->setDate(new \DateTime);
        $comment3->setContent('comment3');
        $comment3->setActualitys($actuality);
        $comment3->setCreated(new \DateTime);
        $comment3->setUpdated(new \DateTime);

        $comment4 = new Comment();
        $comment4->setDate(new \DateTime);
        $comment4->setContent('comment1');
        $comment4->setActualitys($actuality2);
        $comment4->setCreated(new \DateTime);
        $comment4->setUpdated(new \DateTime);

        $comment5 = new Comment();
        $comment5->setDate(new \DateTime);
        $comment5->setContent('comment2');
        $comment5->setActualitys($actuality2);
        $comment5->setCreated(new \DateTime);
        $comment5->setUpdated(new \DateTime);

        $comment6 = new Comment();
        $comment6->setDate(new \DateTime);
        $comment6->setContent('comment3');
        $comment6->setActualitys($actuality2);
        $comment6->setCreated(new \DateTime);
        $comment6->setUpdated(new \DateTime);

        $comment7 = new Comment();
        $comment7->setDate(new \DateTime);
        $comment7->setContent('comment1');
        $comment7->setActualitys($actuality3);
        $comment7->setCreated(new \DateTime);
        $comment7->setUpdated(new \DateTime);

        $comment8 = new Comment();
        $comment8->setDate(new \DateTime);
        $comment8->setContent('comment2');
        $comment8->setActualitys($actuality3);
        $comment8->setCreated(new \DateTime);
        $comment8->setUpdated(new \DateTime);

        $comment9 = new Comment();
        $comment9->setDate(new \DateTime);
        $comment9->setContent('comment3');
        $comment9->setActualitys($actuality3);
        $comment9->setCreated(new \DateTime);
        $comment9->setUpdated(new \DateTime);

        $comment10 = new Comment();
        $comment10->setDate(new \DateTime);
        $comment10->setContent('comment1');
        $comment10->setActualitys($actuality4);
        $comment10->setCreated(new \DateTime);
        $comment10->setUpdated(new \DateTime);

        $comment11 = new Comment();
        $comment11->setDate(new \DateTime);
        $comment11->setContent('comment2');
        $comment11->setActualitys($actuality4);
        $comment11->setCreated(new \DateTime);
        $comment11->setUpdated(new \DateTime);

        $comment12 = new Comment();
        $comment12->setDate(new \DateTime);
        $comment12->setContent('comment3');
        $comment12->setActualitys($actuality4);
        $comment12->setCreated(new \DateTime);
        $comment12->setUpdated(new \DateTime);

        $comment13 = new Comment();
        $comment13->setDate(new \DateTime);
        $comment13->setContent('comment1');
        $comment13->setActualitys($actuality5);
        $comment13->setCreated(new \DateTime);
        $comment13->setUpdated(new \DateTime);

        $comment14 = new Comment();
        $comment14->setDate(new \DateTime);
        $comment14->setContent('comment2');
        $comment14->setActualitys($actuality5);
        $comment14->setCreated(new \DateTime);
        $comment14->setUpdated(new \DateTime);

        $comment15 = new Comment();
        $comment15->setDate(new \DateTime);
        $comment15->setContent('comment1');
        $comment15->setActualitys($actuality6);
        $comment15->setCreated(new \DateTime);
        $comment15->setUpdated(new \DateTime);

        $comment16 = new Comment();
        $comment16->setDate(new \DateTime);
        $comment16->setContent('comment2');
        $comment16->setActualitys($actuality6);
        $comment16->setCreated(new \DateTime);
        $comment16->setUpdated(new \DateTime);

        $manager->persist($community);
        $manager->persist($userAdmin);
        $manager->persist($userUser);
        $manager->persist($cvAdmin);
        $manager->persist($cvUser);
        $manager->persist($experience_type1);
        $manager->persist($experience_type2);
        $manager->persist($experienceAdmin);
        $manager->persist($experienceAdmin2);
        $manager->persist($experienceAdmin3);
        $manager->persist($experienceUser);
        $manager->persist($experienceUser2);
        $manager->persist($experienceUser3);
        $manager->persist($competence);
        $manager->persist($competence2);
        $manager->persist($competence3);
        $manager->persist($hobby);
        $manager->persist($hobby2);
        $manager->persist($hobby3);
        $manager->persist($hobby4);
        $manager->persist($hobby5);
        $manager->persist($hobby6);
        $manager->persist($hobby7);
        $manager->persist($hobby8);
        $manager->persist($actuality);
        $manager->persist($actuality2);
        $manager->persist($actuality3);
        $manager->persist($actuality4);
        $manager->persist($actuality5);
        $manager->persist($actuality6); 
        $manager->persist($comment);
        $manager->persist($comment2);
        $manager->persist($comment3);
        $manager->persist($comment4);
        $manager->persist($comment5);
        $manager->persist($comment6);
        $manager->persist($comment7);
        $manager->persist($comment8);
        $manager->persist($comment9);
        $manager->persist($comment10);
        $manager->persist($comment11);
        $manager->persist($comment12);
        $manager->persist($comment13);
        $manager->persist($comment14);
        $manager->persist($comment15);
        $manager->persist($comment16);

        $manager->flush();

    }
}