<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Unetwork\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Unetwork\AdminBundle\Entity\User;
use Unetwork\AdminBundle\Entity\Community;
use Unetwork\AdminBundle\Entity\Section;
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
        $lorem999 = 'Lorem ipsum Cillum labore do labore proident Duis aute id consectetur id veniam magna adipisicing voluptate laboris esse incididunt voluptate id nisi consectetur mollit deserunt anim dolor irure consequat cupidatat aliquip veniam in dolor proident quis ad Duis nisi eiusmod Duis incididunt proident consectetur do dolore laboris deserunt tempor eu consectetur est eu eu consequat eu ullamco ullamco dolore dolor mollit in sed anim reprehenderit adipisicing dolor proident Excepteur Ut amet Excepteur deserunt anim minim eiusmod in laboris fugiat laborum aliquip commodo aute anim consequat amet in magna velit fugiat deserunt Ut non Ut ex magna proident cillum consectetur voluptate do Excepteur qui cillum ullamco Ut dolor adipisicing veniam dolore nisi veniam esse sunt elit dolore cupidatat dolore ad enim aute aliqua voluptate cillum aute sunt mollit irure non cillum minim dolor veniam magna laborum quis ut ea aliquip enim pariatur irure magna nisi et anim adipisicing laboris irure dolor non.';
        $lorem250 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas enim dolor, auctor suscipit nibh nec, facilisis volutpat enim. Quisque sed sagittis lectus, a scelerisque ante. Ut faucibus, arcu at sagittis imperdiet, ipsum enim placerat diam metus.';
        /*
        *   Community
        */
        $community = new Community();
        $community->setName('Informatique');
        $community->setAlias('info');
        $community->setCreated(new \DateTime);
        $community->setUpdated(new \DateTime);

        /*
        *   Section
        */
        $section = new Section();
        $section->setName('Concepteur Réalisateur Web');
        $section->setAlias('crw');
        $section->setCommunity($community);
        $section->setCreated(new \DateTime);
        $section->setUpdated(new \DateTime);

        $section2 = new Section();
        $section2->setName('Chargé de Projet en Systemes Informatiques Appliqués');
        $section2->setAlias('csia');
        $section2->setCommunity($community);
        $section2->setCreated(new \DateTime);
        $section2->setUpdated(new \DateTime);

        $section3 = new Section();
        $section3->setName('Expert en Ingénierie Informatique');
        $section3->setAlias('eii');
        $section3->setCommunity($community);
        $section3->setCreated(new \DateTime);
        $section3->setUpdated(new \DateTime);

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
        $userAdmin->setNom('Admin');
        $userAdmin->setPrenom('Thomas');
        $userAdmin->setVille('Lyon');
        $userAdmin->setTel('0722558877');
        $userAdmin->setDateNais(new \DateTime('1990-01-10'));
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
        $userUser->setNom('User');
        $userUser->setPrenom('Jonathan');
        $userUser->setVille('Villeurbanne');
        $userUser->setTel('0799883322');
        $userUser->setDateNais(new \DateTime('1990-07-22'));
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
        $cvAdmin->setPresentation($lorem250);
        $cvAdmin->setJobname('Webmaster');
        $cvAdmin->setUser($userAdmin);
        $cvAdmin->setCreated(new \DateTime);
        $cvAdmin->setUpdated(new \DateTime);

        $cvUser = new Cv();
        $cvUser->setPresentation($lorem250);
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
        *   Competence
        */
        $competence = new Competence();
        $competence->setCv($cvUser);
        $competence->setName('HTML5 CSS3');
        $competence->setNote(4);
        $competence->setCreated(new \DateTime);
        $competence->setUpdated(new \DateTime);

        $competence2 = new Competence();
        $competence2->setCv($cvUser);
        $competence2->setName('PHP Symphony2');
        $competence2->setNote(3);
        $competence2->setCreated(new \DateTime);
        $competence2->setUpdated(new \DateTime);

        $competence3 = new Competence();
        $competence3->setCv($cvUser);
        $competence3->setName('Javascript');
        $competence3->setNote(2);
        $competence3->setCreated(new \DateTime);
        $competence3->setUpdated(new \DateTime);

        /*
        *   Hobby
        */
        $hobby = new Hobby();
        $hobby->setCv($cvUser);
        $hobby->setName('Athlétisme');
        $hobby->setCreated(new \DateTime);
        $hobby->setUpdated(new \DateTime);

        $hobby2 = new Hobby();
        $hobby2->setCv($cvUser);
        $hobby2->setName('Photographie');
        $hobby2->setCreated(new \DateTime);
        $hobby2->setUpdated(new \DateTime);

        $hobby3 = new Hobby();
        $hobby3->setCv($cvUser);
        $hobby3->setName('Randonnée');
        $hobby3->setCreated(new \DateTime);
        $hobby3->setUpdated(new \DateTime);

        $hobby4 = new Hobby();
        $hobby4->setCv($cvUser);
        $hobby4->setName('Mode');
        $hobby4->setCreated(new \DateTime);
        $hobby4->setUpdated(new \DateTime);

        $hobby5 = new Hobby();
        $hobby5->setCv($cvUser);
        $hobby5->setName('Lecture');
        $hobby5->setCreated(new \DateTime);
        $hobby5->setUpdated(new \DateTime);

        $hobby6 = new Hobby();
        $hobby6->setCv($cvUser);
        $hobby6->setName('Informatique');
        $hobby6->setCreated(new \DateTime);
        $hobby6->setUpdated(new \DateTime);

        $hobby7 = new Hobby();
        $hobby7->setCv($cvUser);
        $hobby7->setName('Parachutisme');
        $hobby7->setCreated(new \DateTime);
        $hobby7->setUpdated(new \DateTime);

        $hobby8 = new Hobby();
        $hobby8->setCv($cvUser);
        $hobby8->setName('Peinture');
        $hobby8->setCreated(new \DateTime);
        $hobby8->setUpdated(new \DateTime);

        /*
        *   Experience
        */
        $experienceAdmin = new Experience();
        $experienceAdmin->setCv($cvAdmin);
        $experienceAdmin->setType($experience_type1);
        $experienceAdmin->setName('Quisque facilisis nibh');
        $experienceAdmin->setDescription($lorem999);
        $experienceAdmin->setBegin(new \DateTime('2011-01-01'));
        $experienceAdmin->setEnd(new \DateTime('2012-02-01'));
        $experienceAdmin->setCreated(new \DateTime);
        $experienceAdmin->setUpdated(new \DateTime);

        $experienceAdmin2 = new Experience();
        $experienceAdmin2->setCv($cvAdmin);
        $experienceAdmin2->setType($experience_type2);
        $experienceAdmin2->setName('Etiam a dictum urna');
        $experienceAdmin2->setDescription($lorem999);
        $experienceAdmin2->setBegin(new \DateTime('2012-03-01'));
        $experienceAdmin2->setEnd(new \DateTime('2013-05-01'));
        $experienceAdmin2->setCreated(new \DateTime);
        $experienceAdmin2->setUpdated(new \DateTime);

        $experienceAdmin3 = new Experience();
        $experienceAdmin3->setCv($cvAdmin);
        $experienceAdmin3->setType($experience_type1);
        $experienceAdmin3->setName('Proin rutrum');
        $experienceAdmin3->setDescription($lorem999);
        $experienceAdmin3->setBegin(new \DateTime('2013-06-01'));
        $experienceAdmin3->setEnd(new \DateTime('2014-02-01'));
        $experienceAdmin3->setCreated(new \DateTime);
        $experienceAdmin3->setUpdated(new \DateTime);


        $experienceUser = new Experience();
        $experienceUser->setCv($cvUser);
        $experienceUser->setType($experience_type1);
        $experienceUser->setName('Praesent consequat');
        $experienceUser->setDescription($lorem999);
        $experienceUser->setBegin(new \DateTime('2011-01-01'));
        $experienceUser->setEnd(new \DateTime('2012-02-01'));
        $experienceUser->setCreated(new \DateTime);
        $experienceUser->setUpdated(new \DateTime);

        $experienceUser2 = new Experience();
        $experienceUser2->setCv($cvUser);
        $experienceUser2->setType($experience_type1);
        $experienceUser2->setName('Aliquam massa felis');
        $experienceUser2->setDescription($lorem999);
        $experienceUser2->setBegin(new \DateTime('2012-03-01'));
        $experienceUser2->setEnd(new \DateTime('2013-05-01'));
        $experienceUser2->setCreated(new \DateTime);
        $experienceUser2->setUpdated(new \DateTime);

        $experienceUser3 = new Experience();
        $experienceUser3->setCv($cvUser);
        $experienceUser3->setType($experience_type1);
        $experienceUser3->setName('Praesent ligula');
        $experienceUser3->setDescription($lorem999);
        $experienceUser3->setBegin(new \DateTime('2013-06-01'));
        $experienceUser3->setEnd(new \DateTime('2014-02-01'));
        $experienceUser3->setCreated(new \DateTime);
        $experienceUser3->setUpdated(new \DateTime);

        /*
        *   Actuality
        */
        $actuality = new Actuality();
        $actuality->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nisi orci, pretium vel pharetra a, facilisis vel justo. Nam tempus libero sit amet sagittis hendrerit. Integer sit amet urna pellentesque, condimentum sem in, porta arcu. Praesent faucibus odio sed faucibus rutrum. Ut feugiat, odio id laoreet rutrum');
        $actuality->setCreated(new \DateTime);
        $actuality->setUpdated(new \DateTime);
        $actuality->setSection($section);

        $actuality2 = new Actuality();
        $actuality2->setDescription('Ut feugiat, odio id laoreet rutrum, purus felis ultricies lectus, in convallis tellus diam ultrices quam. Duis porta sed ante ac blandit. Pellentesque at sollicitudin dui. Morbi pellentesque, erat quis convallis nullam.');
        $actuality2->setCreated(new \DateTime);
        $actuality2->setUpdated(new \DateTime);
        $actuality2->setSection($section);

        $actuality3 = new Actuality();
        $actuality3->setDescription('Nam tempus libero sit amet sagittis hendrerit. Integer sit amet urna pellentesque, condimentum sem in, porta arcu. Praesent faucibus odio sed faucibus rutrum');
        $actuality3->setCreated(new \DateTime);
        $actuality3->setUpdated(new \DateTime);
        $actuality3->setSection($section);

        $actuality4 = new Actuality();
        $actuality4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nisi orci, pretium vel pharetra a, facilisis vel justo. Nam tempus libero sit amet sagittis hendrerit. Integer sit amet urna pellentesque, condimentum sem in, porta arcu. Praesent faucibus odio sed faucibus rutrum. Ut feugiat, odio id laoreet rutrum, purus felis ultricies lectus, in convallis tellus diam ultrices quam. Duis porta sed ante ac blandit. Pellentesque at sollicitudin dui. Morbi pellentesque, erat quis convallis nullam.');
        $actuality4->setCreated(new \DateTime);
        $actuality4->setUpdated(new \DateTime);
        $actuality4->setSection($section);

        $actuality5 = new Actuality();
        $actuality5->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nisi orci, pretium vel pharetra a, facilisis vel justo. ');
        $actuality5->setCreated(new \DateTime);
        $actuality5->setUpdated(new \DateTime);
        $actuality5->setSection($section);

        $actuality6 = new Actuality();
        $actuality6->setDescription('Praesent faucibus odio sed faucibus rutrum. Ut feugiat, odio id laoreet rutrum, purus felis ultricies lectus, in convallis tellus diam ultrices quam. Duis porta sed ante ac blandit. Pellentesque at sollicitudin dui.');
        $actuality6->setCreated(new \DateTime);
        $actuality6->setUpdated(new \DateTime);
        $actuality6->setSection($section);

        /*
        *   Comment
        */
        $comment = new Comment();
        $comment->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit');
        $comment->setActualitys($actuality);
        $comment->setUser($userUser);
        $comment->setCreated(new \DateTime);
        $comment->setUpdated(new \DateTime);

        $comment2 = new Comment();
        $comment2->setContent('Maecenas nisi orci, pretium vel pharetra a, facilisis vel justo');
        $comment2->setActualitys($actuality);
        $comment2->setUser($userUser);
        $comment2->setCreated(new \DateTime);
        $comment2->setUpdated(new \DateTime);

        $comment3 = new Comment();
        $comment3->setContent('Vivamus vulputate sem vitae turpis elementum');
        $comment3->setActualitys($actuality);
        $comment3->setUser($userUser);
        $comment3->setCreated(new \DateTime);
        $comment3->setUpdated(new \DateTime);

        $comment4 = new Comment();
        $comment4->setContent('Nam dolor est');
        $comment4->setActualitys($actuality2);
        $comment4->setUser($userUser);
        $comment4->setCreated(new \DateTime);
        $comment4->setUpdated(new \DateTime);

        $comment5 = new Comment();
        $comment5->setContent('Vivamus vulputate sem vitae turpis elementum, a viverra arcu euismod');
        $comment5->setActualitys($actuality2);
        $comment5->setUser($userUser);
        $comment5->setCreated(new \DateTime);
        $comment5->setUpdated(new \DateTime);

        $comment6 = new Comment();
        $comment6->setContent('In a ligula id justo imperdiet');
        $comment6->setActualitys($actuality2);
        $comment6->setUser($userUser);
        $comment6->setCreated(new \DateTime);
        $comment6->setUpdated(new \DateTime);

        $comment7 = new Comment();
        $comment7->setContent('Praesent eu pretium diam');
        $comment7->setActualitys($actuality3);
        $comment7->setUser($userUser);
        $comment7->setCreated(new \DateTime);
        $comment7->setUpdated(new \DateTime);

        $comment8 = new Comment();
        $comment8->setContent('Lorem ipsum dolor sit amet');
        $comment8->setActualitys($actuality3);
        $comment8->setUser($userUser);
        $comment8->setCreated(new \DateTime);
        $comment8->setUpdated(new \DateTime);

        $comment9 = new Comment();
        $comment9->setContent('Sed faucibus ante id arcu porttitor tincidun');
        $comment9->setActualitys($actuality3);
        $comment9->setUser($userUser);
        $comment9->setCreated(new \DateTime);
        $comment9->setUpdated(new \DateTime);

        $comment10 = new Comment();
        $comment10->setContent('eros varius ut');
        $comment10->setActualitys($actuality4);
        $comment10->setUser($userUser);
        $comment10->setCreated(new \DateTime);
        $comment10->setUpdated(new \DateTime);

        $comment11 = new Comment();
        $comment11->setContent('Phasellus dictum ipsum odio');
        $comment11->setActualitys($actuality4);
        $comment11->setUser($userUser);
        $comment11->setCreated(new \DateTime);
        $comment11->setUpdated(new \DateTime);

        $comment12 = new Comment();
        $comment12->setContent('Lorem ipsum dolor sit amet');
        $comment12->setActualitys($actuality4);
        $comment12->setUser($userUser);
        $comment12->setCreated(new \DateTime);
        $comment12->setUpdated(new \DateTime);

        $comment13 = new Comment();
        $comment13->setContent('Sed faucibus ante id arcu porttitor tincidun');
        $comment13->setActualitys($actuality5);
        $comment13->setUser($userUser);
        $comment13->setCreated(new \DateTime);
        $comment13->setUpdated(new \DateTime);

        $comment14 = new Comment();
        $comment14->setContent('eros varius ut');
        $comment14->setActualitys($actuality5);
        $comment14->setUser($userUser);
        $comment14->setCreated(new \DateTime);
        $comment14->setUpdated(new \DateTime);

        $comment15 = new Comment();
        $comment15->setContent('Phasellus dictum ipsum odio');
        $comment15->setActualitys($actuality6);
        $comment15->setUser($userUser);
        $comment15->setCreated(new \DateTime);
        $comment15->setUpdated(new \DateTime);

        $comment16 = new Comment();
        $comment16->setContent('lementum, a viverra arcu euismod');
        $comment16->setActualitys($actuality6);
        $comment16->setUser($userUser);
        $comment16->setCreated(new \DateTime);
        $comment16->setUpdated(new \DateTime);

        $manager->persist($community);

        $manager->persist($section);
        $manager->persist($section2);
        $manager->persist($section3);

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