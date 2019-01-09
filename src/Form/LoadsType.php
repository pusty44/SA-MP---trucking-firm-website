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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoadsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nazwa firmy - zlecenie',
                'required' => true,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Nazwa firmy - zlecenie',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
            ])
            ->add('load', EntityType::class, [
                'class' => Load::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->where('l.available > 0')
                        ->andWhere('l.ended = 0')->orderBy('l.addDate','DESC');
                },
                'label' => 'Wybierz ładunek',
                'required' => false,
                'attr' => [
                    'class' => 'form-control recruit-form',
                    'placeholder' => 'Wybierz ładunek',
                    'data-animate' => "fadeInUp",
                    'data-delay' => ".1"
                ],
                'choice_label' => function ($load) {
                /** @var Load $load */
                if($load->getAvailable() == 1) $end = 'pozostał: 1 ładunek';
                else if($load->getAvailable() > 1 && $load->getAvailable() < 5) $end = 'pozostały: '.$load->getAvailable().' ładunki';
                else $end = 'pozostało: '.$load->getAvailable().' ładunków';
                    return $load->getTitle().' '.$end;
                }
            ])
        ;
    }

}