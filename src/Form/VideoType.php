<?php

namespace App\Form;

use App\Entity\ThemeVideo;
use App\Entity\Video;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'required' => false,
            ])
            ->add('description',CKEditorType::class,[
                'required' => false,
            ])
            ->add('pathToFile',TextType::class,[
                'label' => 'Code of video youtube',
                'required' => false,
            ])
            ->add('theme',EntityType::class,[
                'required' => false,
                'placeholder' => '-- Choose a theme --',
                'class' => ThemeVideo::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
