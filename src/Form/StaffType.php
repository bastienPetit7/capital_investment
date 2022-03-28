<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Name",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name is required.',
                    ])
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => "Phone number",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Phone is required.',
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Email is required.',
                    ])
                ]
            ])
            ->add('role', ChoiceType::class, [
                'label' => "Role",
                'choices' => [
                    'Manager' => 'Manager',
                    'Administrator' => 'Administrator'
                ],
                'required' => false,
                'placeholder' => '--Choose a role--',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Role is required.',
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
