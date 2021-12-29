<?php

namespace App\Form;

use App\Entity\StudyCase;
use App\Entity\ThemeStudyCase;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class StudyCaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'required' => false,
            ])
            ->add('image',DropzoneType::class,[
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2m',
                        'maxSizeMessage' => 'File max size allowed is 2 Mo.',
                    ])
                ]
            ])
            ->add('price',MoneyType::class,[
                'divisor' => 100,
                'required' => false,
            ])
            ->add('theme',EntityType::class,[
                'placeholder' => '-- Choose a theme --',
                'class' => ThemeStudyCase::class
            ])
            ->add('file',DropzoneType::class,[
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10m',
                        'maxSizeMessage' => 'File max size allowed is 10 Mo.',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudyCase::class,
        ]);
    }
}
