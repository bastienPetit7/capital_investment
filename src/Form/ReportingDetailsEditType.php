<?php

namespace App\Form;

use App\Entity\ReportingDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class ReportingDetailsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $month = $options['month']; 
        $year = $options['year'];

        $builder
            ->add('month', ChoiceType::class, [
                'choices' => [
                    "January" => "January",
                    "February" => "February",
                    "March" => "March",
                    "April" => "April",
                    "May" => "May",
                    "June" => "June",
                    "Jully" => "Jully",
                    "August" => "August",
                    "September" => "September",
                    "October" => "October",
                    "November" => "November",
                    "December" => "December",

                ],
                'mapped' => false, 
                'data' => $month
                
            ])
            ->add('year', ChoiceType::class, [
                'choices' => [
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                    '2028' => '2028',
                    '2029' => '2029',
                    '2030' => '2030',
                    '2031' => '2031',
                    '2032' => '2032',
                ],
                'mapped' => false, 
                'data' => $year
            ])
            ->add('initialWallet', MoneyType::class, [

            ])
            ->add('interest')
            ->add('compoundInterest')
            ->add('actualWallet')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReportingDetails::class,
            'month' => [],
            'year' => []
        ]);
    }
}
