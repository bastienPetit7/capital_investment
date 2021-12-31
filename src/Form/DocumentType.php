<?php

namespace App\Form;

use App\Dictionary\DocumentTypeInvestor;
use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\UX\Dropzone\Form\DropzoneType;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file',DropzoneType::class,[
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3m',
                        'maxSizeMessage' => 'File max size allowed is 3 Mo.',
                    ]),
                    new NotBlank([
                        'message' => 'File is required.',
                    ])
                ]
            ])
            ->add('type',ChoiceType::class,[
                'choices' => [
                    DocumentTypeInvestor::ACT_OF_PURCHASE => DocumentTypeInvestor::ACT_OF_PURCHASE,
                    DocumentTypeInvestor::ACT_OF_SALE => DocumentTypeInvestor::ACT_OF_SALE,
                    DocumentTypeInvestor::OPERATION_STATEMENT => DocumentTypeInvestor::OPERATION_STATEMENT,
                ],
                'placeholder' => '-- Choose a type --',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
