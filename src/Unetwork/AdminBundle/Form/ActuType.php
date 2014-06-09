<?php

namespace Unetwork\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description', 'textarea');
        $builder->add('section', 'entity', array(
            'class' => 'UnetworkAdminBundle:Section',
            'property' => 'label',
            /*
            'property' => function($data) {
                 return sprintf('%s (%s)', $data->name, $data->getCommunnity()->getName());
             },
             */
        ));
        $builder->add('file', 'file', array(
            'label' => 'Image',
            'required' => false,
        ));
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