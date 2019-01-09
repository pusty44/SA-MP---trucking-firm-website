<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 09.01.2019
 * Time: 00:45
 */

namespace App\Form;


use App\Entity\Load;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoadsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('load', EntityType::class, [
                'class' => Load::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.available=:av')
                        ->andWhere('l.user is NULL')
                        ->setParameter(':av',true);
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

}