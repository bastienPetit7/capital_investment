<?php

namespace App\Form;

use App\Entity\Position;
use App\Entity\PositionType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PositionType as EntityPositionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PositionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Position's name", 

            ])
            ->add('tp1', NumberType::class, [
                'label' => "tp1",
                'required' => false
            ])
            ->add('tp2', NumberType::class, [
                'label' => "tp2",
                'required' => false
            ])
            ->add('tp3',  NumberType::class, [
                'label' => "tp3",
                'required' => false
            ])
            ->add('tp4',  NumberType::class, [
                'label' => "tp4",
                'required' => false
            ])
            ->add('tp5',  NumberType::class, [
                'label' => "tp5",
                'required' => false
            ])
            ->add('tp6',  NumberType::class, [
                'label' => "tp6",
                'required' => false
            ])
            ->add('tp7',  NumberType::class, [
                'label' => "tp8",
                'required' => false
            ])
            ->add('tp8',  NumberType::class, [
                'label' => "tp9",
                'required' => false
            ])
            ->add('stopLoss',  NumberType::class, [
                'label' => 'stopLoss',
            ])
            // ->add('createdAt', DateType::class, [
            //     'label' => true,
            //     'widget' => 'single_text', 
            //     'html5' => false, 
            //     'attr' => [ 'class' => 'js-datepicker']
            // ])
            ->add('sellAt', NumberType::class, [
                'label' => "Sell At",
                'required'=> false
            ] )
            ->add('isActive', ChoiceType::class ,[
                'choices' => [
                    'Active' => 1, 
                    'Unactive' => 0
                ],
                'label' => 'isActive'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Position::class,
        ]);
    }
}
