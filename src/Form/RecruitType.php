<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 19:14
 */

namespace App\Form;


use App\Entity\Recruit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecruitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serverNick', TextType::class, [
                'label' => 'Nick na serwerze',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź swój nick z serwera',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać nick z serwera',
                    ]),
                ],
            ])
            ->add('forumNick', TextType::class, [
                'label' => 'Nick na serwerze',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź swój nick z forum',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać nick z forum',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adres e-mail',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź swój adres e-mail',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać link do profilu steam',
                    ]),
                ],
            ])
            ->add('profileLink', TextType::class, [
                'label' => 'Link do profilu w panelu',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź link do profilu w panelu',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać link do profilu steam',
                    ]),
                ],
            ])
            ->add('practice', TextType::class, [
                'label' => 'Staż w grze',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Staż w grze',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wprowadzić staż w grze',
                    ]),
                ],
            ])
            ->add('age', TextType::class, [
                'label' => 'Wiek',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź swój wiek',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać swój wiek',
                    ]),
                ],
            ])
            ->add('avatar', FileType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'required' => true,
                    'id' => 'avatar',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ]
            ])
            ->add('coverPhoto', FileType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'required' => true,
                    'id' => 'coverPhoto',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Recruit::class,
        ));
    }


}