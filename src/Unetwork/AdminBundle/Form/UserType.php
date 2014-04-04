<?php
// src/Acme/TaskBundle/Form/Type/CategoryType.php
namespace Unetwork\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
        $builder->add('password', 'password');
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('roles', 'choice', array(
            'choices'   => array('ROLE_ADMIN'=>'Admin', 'ROLE_USER'=>'User'),
            'expanded'  => true,
            'required'  => true,
        ));
        $builder->add('save', 'submit');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unetwork\AdminBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user';
    }
}