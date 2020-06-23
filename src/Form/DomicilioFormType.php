<?php

namespace App\Form;

use App\Entity\Domicilio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DomicilioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calle', TextType::class, [
                'empty_data' => '',
                'constraints' => [
                    new NotBlank([
                        'message' => 'no en blanco'
                    ])
                ]

            ] )
            ->add('portal')
            ->add('piso')
            ->add('escalera', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 2,
                        'maxMessage' => 'Introduzca un número que tenga como máximo 2 dígitos'
                    ])
                ]
            ])
            ->add('ciudad')
            ->add('provincia')
            ->add('zip', IntegerType::class, [
                'label' => "Código Postal",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Domicilio::class,
        ]);
    }
}
