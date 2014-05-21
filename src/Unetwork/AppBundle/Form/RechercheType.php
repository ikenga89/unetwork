<?php
namespace Unetwork\AppinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text');
        $builder->add('Rechercher', 'submit'/* , array(
        'validation_groups' => false,)*/
        );
    }
}