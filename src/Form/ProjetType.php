<?php

namespace App\Form;

use App\Entity\Projet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('image', FileType::class, [
                'label' => 'upload image',
                'mapped' => false

            ])
            ->add('date_creation', DateType::class, array(
                'format' => 'yyyy-MMdd',
            ))

            ->add('statut', ChoiceType::class, array(
                'choices' => array(
                    'en cours' => 'en cours',
                    'Terminer' => 'Terminer',
                )
            ));;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
