<?php

namespace App\Form;

use App\Entity\DatoDeContacto;
use App\Repository\ClienteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DatoDeContactoFormType extends AbstractType
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
               'label' => 'E-mail',
                'required' => false,
                'constraints' => [
                    new Email([
                        'message' => "Email no válido"
                    ])
                ]
            ])
            ->add('telefono', IntegerType::class, [
                'label' => 'Teléfono',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '[6789]',
                        'message' => 'nooop'
                    ])
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatoDeContacto::class,
        ]);
    }
}
