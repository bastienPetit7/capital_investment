<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SharedDateFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month', ChoiceType::class, [
                'label' => "Month",
                'placeholder' => 'Month',
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
                'label' => "Year",
                'placeholder' => 'Year',
                'choices' => $this->getYearChoices(),
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Year is required.',
                    ])
                ]
            ]);

    }

    public function getYearChoices(): array
    {
        $currentYear = (int) date('Y');
        $yearChoices = [];

        for ($i = $currentYear - 3; $i <= $currentYear; $i++) {
            $yearChoices[$i] = $i;
        }

        return $yearChoices;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }

}