<?php

namespace Unetwork\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'choice', array(
            'class' => 'UnetworkAdminBundle:Community',
            'property' => 'name',
        ));
        $builder->add('name', 'text');
        $builder->add('description', 'text');
        $builder->add('begin', 'datetime');
        $builder->add('end', 'datetime');
        $builder->add('Envoyer', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unetwork\AdminBundle\Entity\Actuality',
        ));
    }

    public function getName()
    {
        return 'actuality';
    }
}