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
        ));
        $builder->add('begin', 'datetime', array(
            'label' => 'Début',
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
        ));
        $builder->add('end', 'datetime', array(
            'label' => 'Fin',
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
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