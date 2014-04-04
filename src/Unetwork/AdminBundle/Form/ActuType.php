<?php

namespace unetwork\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description', 'textarea');
        $builder->add('community', 'entity', array(
            'class' => 'UnetworkAdminBundle:Community',
            'property' => 'name',
        ));
        $builder->add('created');
        $builder->add('updated');
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