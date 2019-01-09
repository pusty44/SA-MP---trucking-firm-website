<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 05.08.2018
 * Time: 16:26
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Twój adres e-mail',
                'required' => true,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wprowadź swój nick z serwera',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać email z serwera',
                    ]),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Twój adres e-mail',
                'required' => true,
                'disabled' => true,
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
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Hasło'),
                'second_options' => array('label' => 'Powtórz hasło'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}