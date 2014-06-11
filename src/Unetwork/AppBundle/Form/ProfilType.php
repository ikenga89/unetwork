<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text');
        $builder->add('prenom', 'text');
        $builder->add('ville', 'text');
        $builder->add('tel', 'text');
        $builder->add('date_nais', 'datetime', array(
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
        ));
        $builder->add('linkedin', 'text');
        $builder->add('viadeo', 'text');
        $builder->add('twitter', 'text');
        $builder->add('url', 'text');
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