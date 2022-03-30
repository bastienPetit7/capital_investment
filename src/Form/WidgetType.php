<?php

namespace App\Form;

use App\Entity\ThemeVideo;
use App\Entity\Video;
use App\Entity\Widget;
use App\Entity\WidgetTheme;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
            ])
            ->add('bgColor',ChoiceType::class,[
                'choices' => [
                    'dark' => 'dark',
                    'light' => 'light'
                ]
            ])
            ->add('widgetTheme',EntityType::class,[
                'choice_label' => 'name',
                'placeholder' => '-- Choose a wallet --',
                'class' => WidgetTheme::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Widget::class,
        ]);
    }
}
