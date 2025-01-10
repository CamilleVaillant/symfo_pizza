<?php

namespace App\Form;

use App\Entity\Patte;
use App\Entity\Pizza;
use App\Entity\Ingredients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('sacret_ingredient')
            ->add('patte',EntityType::class,[
                'class' => Patte::class,
                'choice_label' => 'type', // Propriété affichée
                'multiple' => false,     // Choix unique (ManyToOne)
                'expanded' => false,     // Liste déroulante
            ])
            ->add('ingredients',EntityType::class,[
                'class' => Ingredients::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
