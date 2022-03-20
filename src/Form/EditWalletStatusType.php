<?php

namespace App\Form;

use App\Dictionary\ProfileInvestorWalletStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditWalletStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

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


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
