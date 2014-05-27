<?php

namespace unetwork\AppBundle\Form;

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
        $builder->add('date_nais', 'datetime');
        $builder->add('linkedin', 'text');
        $builder->add('viadeo', 'text');
        $builder->add('twitter', 'text');
        $builder->add('url', 'text');
        $builder->add('file', 'file', array('required' => false));
        $builder->add('Enregistrer', 'submit');
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