<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\UtilisateurType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('password', PasswordType::class)
            /*  ->add('role', ChoiceType::class, array(
                'choices' => array(
                    'admin' => 'ROLE_ADMIN',
                    'user' => 'ROLE_USER',
                )
            ))*/
            ->add('confirm_password', PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
