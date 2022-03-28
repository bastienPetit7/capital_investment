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

class WalletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('initialAmount', MoneyType::class, [
                'label' => "Initial Amount",
                'attr' => [
                    'placeholder' => 'Initial deposit amount',
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Wallet Actual Amount is required.',
                    ])
                ]
            ])
            ->add('status', ChoiceType::class, [
                'label' => "Status",
                'placeholder' => '-- Select a status --',
                'required' => false,
                'choices' => [
                    ProfileInvestorWalletStatus::INVESTOR_STARTER =>  ProfileInvestorWalletStatus::INVESTOR_STARTER,
                    ProfileInvestorWalletStatus::INVESTOR_SILVER =>  ProfileInvestorWalletStatus::INVESTOR_SILVER,
                    ProfileInvestorWalletStatus::INVESTOR_GOLD =>  ProfileInvestorWalletStatus::INVESTOR_GOLD,
                    ProfileInvestorWalletStatus::INVESTOR_PLATINUM =>  ProfileInvestorWalletStatus::INVESTOR_PLATINUM
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Status investor is required.',
                    ])
                ]
            ])
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
                ]
            ])
            ->add('interestType', ChoiceType::class, [
                'label' => "Interest Rate Type",
                'placeholder' => '-- Select a type --',
                'required' => false,
                'choices' => [
                    ProfileInvestorRateType::INVESTOR_INTEREST_CLASSIC =>  ProfileInvestorRateType::INVESTOR_INTEREST_CLASSIC,
                    ProfileInvestorRateType::INVESTOR_INTEREST_COMPOUND =>  ProfileInvestorRateType::INVESTOR_INTEREST_COMPOUND
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Interest rate type is required.',
                    ])
                ]
            ])
            ->add('currency', ChoiceType::class, [
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
            ->add('interestRecoveryFound', MoneyType::class, [
                'label' => "Interest Recovery Found",
                'attr' => [
                    'placeholder' => 'amount',
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Interest Recovery Found amount is required.',
                    ])
                ]
            ])
            ->add('totalActif', MoneyType::class, [
                'label' => "Total Actif",
                'attr' => [
                    'placeholder' => 'amount',
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Total Actif amount is required.',
                    ])
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wallet::class,
        ]);
    }
}
