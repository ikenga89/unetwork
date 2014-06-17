<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('presentation', 'textarea', array(
            'label' => 'Votre présentation',
            'max_length' => 250,
        ));
        $builder->add('jobname', 'text', array(
            'label' => 'Nom de l\'emploi actuel',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unetwork\AdminBundle\Entity\Cv',
        ));
    }

    public function getName()
    {
        return 'cv';
    }
}