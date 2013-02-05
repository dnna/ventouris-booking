<?php

namespace Ventouris\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options);

        $builder
            ->add('name', 'text', array('error_bubbling' => true, 'required' => true))
            ->add('surname', 'text', array('error_bubbling' => true, 'required' => true))
            ->add('email', 'email', array('error_bubbling' => true))
            ->add('plainPassword', 'password', array('error_bubbling' => true));
    }

    public function getName()
    {
        return 'ventouris_user_registration';
    }
}
