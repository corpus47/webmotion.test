<?php

namespace App\Form;

use App\Entity\Addresses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class,[
                'choices' => [
                    "Válasszon" => null,
                    "Magánszemély" => 0,
                    "Cég" => 1,
                ],
            ])
            ->add('name',TextType::class)
            ->add('phone',TelType::class)
            ->add('taxnum',TextType::class)
            ->add('country',TextType::class)
            ->add('postcode',TextType::class)
            ->add('city',TextType::class)
            ->add('street',TextType::class)
            ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success mt-3'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Addresses::class,
        ]);
    }
}
