<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zipCode', TextType::class)
            ->add('range', ChoiceType::class, [
                'choices' => [
                    '10km' => 10,
                    '20km' => 20,
                    '50km' => 50
                ]
            ])
        ;
    }
}