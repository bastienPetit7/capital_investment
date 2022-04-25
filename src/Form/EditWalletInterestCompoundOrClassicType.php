<?php

namespace App\Form;

use App\Dictionary\ProfileInvestorRateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditWalletInterestCompoundOrClassicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                ],
                'data' => $options['data']['interestType']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
