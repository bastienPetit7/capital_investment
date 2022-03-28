<?php

namespace App\Form;

use App\Dictionary\Currency;
use App\Dictionary\ProfileInvestorRateType;
use App\Dictionary\ProfileInvestorWalletStatus;
use App\Entity\Wallet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditWalletCurrencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currency', ChoiceType::class, [
                'data' => $options['data']['currency'],
                'label' => "Currency",
                'placeholder' => '-- Select a currency --',
                'required' => false,
                'choices' => [
                    Currency::EURO_SIGN =>  Currency::EURO_SIGN,
                    Currency::DOLLAR_SIGN =>  Currency::DOLLAR_SIGN,
                    Currency::FRANC_SUISSE_SIGN =>  Currency::FRANC_SUISSE_SIGN,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Currency type is required.',
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
