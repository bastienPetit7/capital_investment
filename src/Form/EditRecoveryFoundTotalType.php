<?php

namespace App\Form;

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

class EditRecoveryFoundTotalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recoveryfoundtotal', MoneyType::class, [
                'data' => $options['data']['recoveryfoundtotal'],
                'label' => "Recovery Found Total",
                'attr' => [
                    'placeholder' => 'amount',
                ],
                'divisor' => 100,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Amount is required.',
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
