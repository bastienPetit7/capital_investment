<?php

namespace App\Form;

use App\Entity\Reporting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportingInvestorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',

            ])
            ->add('reportingName', TextType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('wallet', NumberType::class, [
                'mapped' => false
            ])
            ->add('interest', NumberType::class, [
                'mapped' => false
            ])
            ->add('compoundInterest', NumberType::class, [
                'mapped' => false
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reporting::class,
        ]);
    }
}
