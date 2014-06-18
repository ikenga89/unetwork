<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('type', 'entity', array(
            'class' => 'UnetworkAdminBundle:ExperienceType',
            'property' => 'libelle',
            'multiple' => false,
            'expanded' => true,
        ));
        
        $builder->add('name', 'text', array(
            'label' => 'Nom',
        ));
        $builder->add('description', 'text', array(
            'label' => 'Description',
            'required' => false,
        ));
        $builder->add('begin', 'date', array(
            'label' => 'Début',
            'format' => 'ddMMMMyyyy',
        ));
        $builder->add('end', 'date', array(
            'label' => 'Fin',
            'format' => 'ddMMMMyyyy',
            'required' => false,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unetwork\AdminBundle\Entity\Experience',
        ));
    }

    public function getName()
    {
        return 'experience';
    }
}