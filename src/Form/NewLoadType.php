<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 09.01.2019
 * Time: 23:20
 */

namespace App\Form;


use App\Entity\Locations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewLoadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nazwa zlecenia',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Nazwa zlecenia',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
            ])
            ->add('locationStart', EntityType::class, [
                'class' => Locations::class,
                'label' => 'Lokalizacja startowa',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wybierz ładunek',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'choice_label' => 'title',
            ])
            ->add('locationEnd', EntityType::class, [
                'class' => Locations::class,
                'label' => 'Lokalizacja końcowa',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wybierz ładunek',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'choice_label' => 'title',
            ])
        ;
    }
}