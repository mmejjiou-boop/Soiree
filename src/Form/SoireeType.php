<?php

namespace App\Form;

use App\Entity\Soiree;
use App\Entity\Dj;
use App\Entity\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SoireeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('dateSoiree', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateCreation', DateTimeType::class, [
                'widget' => 'single_text',
            ])

            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un thème',
                'required' => false,
            ])

           
            ->add('djs', EntityType::class, [
                'class' => Dj::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ]);
    }

public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        'data_class' => Soiree::class,
    ]);
}
}