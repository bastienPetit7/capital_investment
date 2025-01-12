<?php

namespace App\Form;

use App\Entity\StudyCase;
use App\Entity\ThemeStudyCase;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('subtitle', TextType::class, [
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
                'required' => false,
                'placeholder' => '-- Choose a theme --',
                'class' => ThemeStudyCase::class
            ])
            ->add('description',CKEditorType::class,[
                'required' => false,
            ])
            ->add('extract',CKEditorType::class,[
                'required' => false,
                'label' => 'Extract ( finish it with a cliffhanger followed by (...) '
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
            ->add('isMain', CheckboxType::class, [
                'required' => false, 
                
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false, 

            ])
            ->add('isNew', CheckboxType::class, [
                'required' => false, 

            ])
            ->add('isFree', CheckboxType::class, [
                'required' => false, 

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
