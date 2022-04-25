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
use Symfony\Component\Validator\Constraints\NotBlank;

class PositionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('action', ChoiceType::class, [
                'label' => "Action",
                'placeholder' => '-- Choose an action --',
                'choices' => [
                    '📉 SELL' => '📉 SELL',
                    '📈 BUY' => '📈 BUY',
                ]
            ])
            ->add('activeLeft', ChoiceType::class, [
                'label' => "Active Left",
                'placeholder' => '-- Choose active left --',
                'choices' => [
                    '🇬🇧 GBP' => '🇬🇧 GBP',
                    '🇯🇵 JPY' => '🇯🇵 JPY',
                    '🇺🇸 USD' => '🇺🇸 USD',
                    '🇪🇺 EUR' => '🇪🇺 EUR',
                    '🇨🇦 CAD' => '🇨🇦 CAD',
                    '🇨🇭 CHF' => '🇨🇭 CHF',
                    '🇦🇺 AUD' => '🇦🇺 AUD',
                    '🇳🇿 NZD' => '🇳🇿 NZD',
                    '🔶 XAU' => '🔶 XAU',
                    '⛽ CRUDE OIL' => '⛽ CRUDE OIL',
                    '⛽ BRENT OIL' => '⛽ BRENT OIL',
                    '🏭 US30' => '🏭 US30',
                    '🇺🇸 NAS100' => '🇺🇸 NAS100',
                ]

            ])
            ->add('activeRight', ChoiceType::class, [
                'required' => false,
                'label' => "Active Right",
                'placeholder' => '-- Choose active right --',
                'choices' => [
                    'GBP 🇬🇧' => 'GBP 🇬🇧',
                    'JPY 🇯🇵' => 'JPY 🇯🇵',
                    'USD 🇺🇸' => 'USD 🇺🇸',
                    'EUR 🇪🇺' => 'EUR 🇪🇺',
                    'CAD 🇨🇦' => 'CAD 🇨🇦',
                    'CHF 🇨🇭' => 'CHF 🇨🇭',
                    'AUD 🇦🇺' => 'AUD 🇦🇺',
                    'NZD 🇳🇿' => 'NZD 🇳🇿',
                    'XAU 🔶' => 'XAU 🔶',
                    'CRUDE OIL ⛽' => 'CRUDE OIL ⛽',
                    'BRENT OIL ⛽' => 'BRENT OIL ⛽',
                    'US30 🏭' => 'US30 🏭',
                    'NAS100 🇺🇸' => 'NAS100 🇺🇸',
                ]

            ])
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

            ->add('stopLoss',  NumberType::class, [
                'label' => 'stopLoss',
            ])
            // ->add('createdAt', DateType::class, [
            //     'label' => true,
            //     'widget' => 'single_text', 
            //     'html5' => false, 
            //     'attr' => [ 'class' => 'js-datepicker']
            // ])
            ->add('publishedAt', DateType::class, [
                'label' => "Date of publication",
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Publicated date is required.',
                    ])
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => "Price",
                'required'=> false
            ] )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Position::class,
        ]);
    }
}
