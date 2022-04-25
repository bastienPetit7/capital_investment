<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditWalletInterestRatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('interestRates', NumberType::class, [
                'label' => "Interest rates",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Interest rates amount',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Interest rates is required.',
                    ])
                ],
                'data' => $options['data']['interestRates']
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
