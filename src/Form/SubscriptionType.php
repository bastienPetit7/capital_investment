<?php

namespace App\Form;

use App\Entity\Subscription;
use App\Entity\SubscriptionKeyPoint;
use Symfony\Component\Form\AbstractType;
use Symfony\UX\Dropzone\Form\DropzoneType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Subscription\'s name', 
                'required' => false,
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Subscription\'s subtitle',
                'required' => false
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
                'label' => 'Subscription\'s price', 
                'divisor' => 100,
                'required' => false,
            ])
            ->add('periodInDays')
            ->add('keyPoint_id', EntityType::class, [
                'label' => 'Key points', 
                'mapped' => true,
                'class' => SubscriptionKeyPoint::class,
                'multiple' => true, 
                'expanded' => true, 
            ])
            ->add('shortDescription', CKEditorType::class, [
                'label' => 'Subscription\'s short description, (200 chars max) '
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Subscription\'s description'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
        ]);
    }
}
