<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Event;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('date')
            ->add('content')
            ->add('pictureFile', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'delete_label' => 'Supprimer l\'image ?',
                'download_label' => 'Agrandir l\'image'
            ])
            ->add('location')
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
