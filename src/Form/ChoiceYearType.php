<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChoiceYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('year', ChoiceType::class, [
                'label' => false,
                'placeholder' => '--Filter by year--',
                'choices' => $this->getYearChoices(),
                'data' => $options['data']['year'],
                'required' => false,
            ])
        ;
    }

    public function getYearChoices(): array
    {
        $currentYear = (int) date('Y');
        $yearChoices = [];

        for($i = 2018; $i <= $currentYear; $i++) {
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
