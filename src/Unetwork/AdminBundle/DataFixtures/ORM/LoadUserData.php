<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Unetwork\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Unetwork\AdminBundle\Entity\User;
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

        

        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.fr');

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userAdmin);
        $password = $encoder->encodePassword('test', $userAdmin->getSalt());
        $userAdmin->setPassword($password);

        $userAdmin->setNom('Nom');
        $userAdmin->setPrenom('Prenom');

        $userAdmin->setRoles(array('ROLE_ADMIN'));

        $manager->persist($userAdmin);
        $manager->flush();
    }
}