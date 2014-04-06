<?php
// src/Acme/TaskBundle/Form/Type/CategoryType.php
namespace Unetwork\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserType extends AbstractType
{

    private $type;

    public function __construct($type = 'create'){
        $this->type = $type;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
        if($this->type=='create'){$builder->add('password', 'password');}
        $builder->add('nom');
        $builder->add('prenom');
        if($this->type=='create'){
            $builder->add('roles', 'choice', array(
                'choices'   => array('ROLE_USER' => 'User', 'ROLE_ADMIN' => 'Admin'),
                'required'  => true,
                'expanded'  => true,
            ));
        }
        $builder->add('save', 'submit');

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