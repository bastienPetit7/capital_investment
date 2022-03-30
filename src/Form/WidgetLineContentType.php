<?php

namespace App\Form;

use App\Entity\ThemeVideo;
use App\Entity\Video;
use App\Entity\Widget;
use App\Entity\WidgetCode;
use App\Entity\WidgetLine;
use App\Entity\WidgetTheme;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetLineContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code',EntityType::class,[
                'required' => false,
                'choice_label' => 'name',
                'placeholder' => '-- Choose a code --',
                'class' => WidgetCode::class
            ])
            ->add('line',EntityType::class,[
                'required' => false,
                'choice_label' => 'name',
                'placeholder' => '-- Choose a line --',
                'choices' => $options['data']['lines'],
                'class' => WidgetLine::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
