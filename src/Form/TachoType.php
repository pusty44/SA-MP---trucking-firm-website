<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 09.01.2019
 * Time: 00:28
 */

namespace App\Form;


use App\Entity\Load;
use App\Entity\Tachograph;
use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TachoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user = $options['user'];
        $builder
            ->add('startKm', IntegerType::class, [
                'label' => 'Licznik początkowy',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Licznik początkowy',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać wartość licznika poczatkowego',
                    ]),
                ],
            ])
            ->add('endKm', IntegerType::class, [
                'label' => 'Licznik kończowy',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Licznik końcowy',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Musisz wpisać wartość licznika końcowego',
                    ]),
                ],
            ])
            ->add('fuel', ChoiceType::class, [
                'label' => 'Tankowanie paliwa',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Tankowanie paliwa',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'choices' => array(
                    'TAK' => true,
                    'NIE' => false,
                ),
                'data' => false
            ])
            ->add('damage', TextareaType::class, [
                'label' => 'Opis zniszczeń',
                'required' => false,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Opis zniszczeń',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
            ])
            ->add('load', EntityType::class, [
                'class' => Load::class,
                'query_builder' => function (EntityRepository $er) use ($user) {
                return $er->createQueryBuilder('l')
                    ->where('l.user = :user')
                    ->orderBy('l.addDate','DESC')
                    ->setParameter(':user',$user);
                },
                'label' => 'Wybierz ładunek',
                'required' => false,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wybierz ładunek',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'choice_label' => 'title'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user');
        $resolver->setDefaults(array(
            'data_class' => Tachograph::class,
        ));
    }

}