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
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class,[
                'choices' => [
                    "Típus" => null,
                    "Magánszemély" => 0,
                    "Cég" => 1,
                ],
            ])
            ->add('name',TextType::class,[
                'attr' => [
                    'Placeholder' => 'Név',
                ]
            ])
            ->add('phone',TelType::class, [
                'attr' => [
                    'Placeholder' => 'Telefonszám ( pl.: +36011234567 )',
                ]
            ])
            ->add('taxnum',TextType::class,[
                'attr' => [
                    'Placeholder' => 'Adószám ( pl.: 12345678-1-12 )',
                ]
            ])
            ->add('country',CountryType::class,[
                'preferred_choices' => ['HU'],
                'attr' => [
                    'placeholder' => 'Válasszon országot!'
                ],
            ])
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
