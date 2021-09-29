<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class,[
                'choices' => [
                    "Típus" => null,
                    "Magánszemély" => '0',
                    "Cég" => '1',
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
            //->add('taxnum')
            ->add('country',ChoiceType::class, [
                'choices' => [
                    "Ország: Magyarország" => 'Magyar',
                    "Ausztria" => 'Ausztria',
                    "Szlovákia" => 'Szlovákia',
                    "Románia" => "Románia",
                    "Ukrajna" => "Ukrajna"
                ],
            ])
            ->add('postcode',TextType::class, [
                'attr' => [
                    'placeholder' => 'Irányítószám'
                ],
            ])
            ->add('city',TextType::class,[
                'attr' => [
                    'placeholder' => 'Helység'
                ],
            ])
            ->add('street',TextType::class,[
                'attr' => [
                    'placeholder' => 'Utca, házszám'
                ],
            ])
            ->add('netto',MoneyType::class,[
                'currency' => 'HUF',
                'attr' => [
                    'placeholder' => 'Netto összeg'
                ]
            ])
            ->add('tax',MoneyType::class,[
                'currency' => 'HUF',
                'attr' => [
                    'placeholder' => 'ÁFA'
                ]
            ])
            ->add('brutto',MoneyType::class,[
                'currency' => 'HUF',
                'attr' => [
                    'placeholder' => 'Brutto összeg'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success mt-3 mb-3'
                ]
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            // ... adding the name field if needed
            $address = $event->getData();
            $form = $event->getForm();

            if($address->getType() == 0) {
                $form->add('taxnum',TextType::class,[
                    'required'   => true,
                    'attr' => [
                        'Placeholder' => 'Adószám ( pl.: 12345678-1-12 )',
                    ]
                ]);
            } else {
                $form->add('taxnum',TextType::class,[
                    'required'   => false,
                    'attr' => [
                        'Placeholder' => 'Adószám ( pl.: 12345678-1-12 )',
                        'class' => 'd-none',
                    ]
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
