<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Pedido;
use App\Entity\Producto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class
            ])
            ->add('producto', EntityType::class, [
                'mapped' => false,
                'class' => Producto::class,
                'multiple' => true
            ])
            ->add('cantidad', IntegerType::class, [
                'mapped' => false,
            ])
            ->add('enviar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pedido::class,
        ]);
    }
}
