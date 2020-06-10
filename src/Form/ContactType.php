<?php

namespace App\Form;

use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-input'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
                ])
                ->add('email', EmailType::class, [
                    'label' => 'E-mail',
                    'attr' => [
                        'class' => 'form-input'
                    ],
                    'label_attr' => [
                        'class' => 'form-label'
                    ]
                    ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                    'attr' => [
                        'class' => 'form-input'
                    ],
                    'label_attr' => [
                        'class' => 'form-label'
                    ]
                    ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                    'attr' => [
                        'class' => 'form-input'
                    ],
                    'label_attr' => [
                        'class' => 'form-label'
                    ]
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
