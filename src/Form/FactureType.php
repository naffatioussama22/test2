<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Client;
use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateDeFacture')
            ->add('payee')
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'numpermis'
            ])
            ->add('contrat',EntityType::class,[
                'class'=>Contrat::class,
                'choice_label'=>'id'
            ])
                    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
    
}
