<?php

namespace App\Form;

use App\Entity\Subscription;
use App\Entity\SubscriptionKeyPoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\UX\Dropzone\Form\DropzoneType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class EditUserInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Name',
                'required' => false,
                'data' => $options['data']['name']
            ])
            ->add('telephone', TextType::class, [
                'label' => "Phone number",
                'data' => $options['data']['telephone']
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'data' => $options['data']['email']
            ])
            ->add('createdAt', DateType::class, [
                'label' => "Date de création du contrat",
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Created date is required.',
                    ])
                ],
                'data' => $options['data']['createdAt']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
