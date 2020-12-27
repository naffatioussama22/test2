<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDepart',DateTimeType::class)
            ->add('dateRetour',DateTimeType::class)
            ->add('kmDepart',IntegerType::class)
            ->add('kmRetour',IntegerType::class)
           
            ->add('voiture',EntityType::class,[
                'class'=>Voiture::class,
                'choice_label'=>'Matricule'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}

