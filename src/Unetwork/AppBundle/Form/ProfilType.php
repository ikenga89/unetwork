<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfilType extends AbstractType
{

    private $type;

    public function __construct($type){
        $this->type = $type;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($this->type == 'profil'){

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
            $builder->add('path_couv', 'choice', array(
                'choices'   => array(
                    '../../../../img/couverture_profil/couv_1.jpg' => '/img/couverture_profil/couv_1.jpg',
                    '../../../../img/couverture_profil/couv_2.jpg' => '/img/couverture_profil/couv_2.jpg',
                    '../../../../img/couverture_profil/couv_3.jpg' => '/img/couverture_profil/couv_3.jpg',
                    '../../../../img/couverture_profil/couv_4.jpg' => '/img/couverture_profil/couv_4.jpg',
                    '../../../../img/couverture_profil/couv_5.jpg' => '/img/couverture_profil/couv_5.jpg',
                    '../../../../img/couverture_profil/couv_6.jpg' => '/img/couverture_profil/couv_6.jpg',
                    '../../../../img/couverture_profil/couv_7.jpg' => '/img/couverture_profil/couv_7.jpg',
                    '../../../../img/couverture_profil/couv_8.jpg' => '/img/couverture_profil/couv_8.jpg',
                    '../../../../img/couverture_profil/couv_9.jpg' => '/img/couverture_profil/couv_9.jpg',
                    '../../../../img/couverture_profil/couv_10.jpg' => '/img/couverture_profil/couv_10.jpg',
                ),
                'multiple' => false,
                'required' => false,
                'expanded' => true,
                'empty_value' => false,
                'label' => 'Image de couverture',
            ));
            /*
            $builder->add('file_couv', 'file', array(
                'label' => 'Photo de couverture',
                'required' => false,
            ));
            */

        }else{

            $builder->add('password', 'repeated', array(
                    'label' => 'Choisissez un mot de passe :',
                    'type' => 'password',
                    'invalid_message' => 'Les mots de passe doivent correspondre',
                    'options' => array('required' => true),
                    'first_options'  => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Mot de passe (validation)'),
                ));

        }
        
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