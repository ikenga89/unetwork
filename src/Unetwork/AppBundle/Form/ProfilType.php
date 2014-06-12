<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text', array(
            'required' => false,
        ));
        $builder->add('prenom', 'text', array(
            'required' => false,
        ));
        $builder->add('ville', 'text', array(
            'required' => false,
        ));
        $builder->add('tel', 'text', array(
            'required' => false,
        ));
        $builder->add('date_nais', 'datetime', array(
            'required' => false,
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
        ));
        $builder->add('linkedin', 'text', array(
            'required' => false,
        ));
        $builder->add('viadeo', 'text', array(
            'required' => false,
        ));
        $builder->add('twitter', 'text', array(
            'required' => false,
        ));
        $builder->add('url', 'text', array(
            'required' => false,
        ));
        $builder->add('file', 'file', array(
            'label' => 'Photo de profil',
            'required' => false,
        ));
        $builder->add('file_couv', 'file', array(
            'label' => 'Photo de couverture',
            'required' => false,
        ));
        $builder->add('password', 'repeated', array(
                    'label' => 'Choisissez un mot de passe :',
                    'type' => 'password',
                    'required' => false,
                    'invalid_message' => 'Les mots de passe doivent correspondre',
                    'options' => array('required' => true),
                    'first_options'  => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Mot de passe (validation)'),
                ));
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