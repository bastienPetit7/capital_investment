<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DepositAmountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('month', ChoiceType::class, [
                'label' => "Deposit Amount",
                'placeholder' => 'Month Period',
                'choices' => [
                    'January' => 'January',
                    'February' => 'February',
                    'March' => 'March',
                    'April' => 'April',
                    'May' => 'May',
                    'June' => 'June',
                    'July' => 'July',
                    'August' => 'August',
                    'September' => 'September',
                    'October' => 'October',
                    'November' => 'November',
                    'December' => 'December',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Month is required.',
                    ])
                ]
            ])
            ->add('year', ChoiceType::class, [
                'label' => "Deposit Amount",
                'placeholder' => 'Year Period',
                'choices' => [
                    '2021' => '2021',
                    '2022' => '2022'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Year is required.',
                    ])
                ]
            ])
            ->add('amount', MoneyType::class, [
                'label' => "Deposit Amount",
                'attr' => [
                    'placeholder' => 'Deposit amount',
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Deposit amount is required.',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
