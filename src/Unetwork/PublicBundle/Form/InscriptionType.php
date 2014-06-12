<?php

namespace Unetwork\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text', array(
            'label' => 'Nom : ',
            'attr' => array(
                'class' => 'text',
            ),
            'constraints' => array(
            new Assert\NotBlank(),
            new Assert\Length(array('min' => 2))
            )
        ));

        $builder->add('email', 'email', array(
            'label' => 'Mail : ',
            'attr' => array(
                'class' => 'text',
            ),
            'constraints' => array(
            new Assert\NotBlank(),
            new Assert\Length(array('min' => 2))
            )
        ));

        $builder->add('section', 'text', array(
            'label' => 'Section : ',
            'attr' => array(
                'class' => 'text',
            ),
            'constraints' => array(
            new Assert\NotBlank(),
            new Assert\Length(array('min' => 2))
            )
        ));

        $builder->add('compose', 'textarea', array(
            'label' => 'Message : ',
            'constraints' => array(
            new Assert\NotBlank(),
            new Assert\Length(array('min' => 2))
            )
        ));

        $builder->add('send', 'submit', array(
            'label' => 'Envoyer',
            'attr' => array(
                'class' => 'button button-style1',
            )
        ));

    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
        ));
    }

    public function getName()
    {
        return 'inscription';
    }
}