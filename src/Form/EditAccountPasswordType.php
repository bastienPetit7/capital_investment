<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditAccountPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword',PasswordType::class,[
                'required' => false,
                'label' => 'Current Password',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Current password is required',
                    ]),
                    new UserPassword([
                        'message' => 'Your current password is not correct.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'New password and confirmation password don\'t match',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => false,
                'mapped' => false,
                'first_options'  => [
                    'label' => 'New password',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'New password is required',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirm new password',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Confirmation password is required',
                        ]),
                    ],
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
