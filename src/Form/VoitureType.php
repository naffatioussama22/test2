<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          
            ->add('matricule',TextType::class)
            ->add('marque',TextType::class, ['required' => false])
            ->add('couleur',TextType::class)
            ->add('carburant',TextType::class)
            ->add('description',TextType::class)
            ->add('Datemiseencirculation',DateTimeType::class)
            ->add('disponibilite')
            ->add('nbrplace',IntegerType::class,array('attr'=>array('min'=>1)))
            ->add('agence',EntityType::class,[
                'class'=>Agence::class,
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
