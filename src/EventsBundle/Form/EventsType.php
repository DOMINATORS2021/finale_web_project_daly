<?php

namespace EventsBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nom',TextType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('type',ChoiceType::class,[
                'choices'=> [
                    'Pêche'=>'Pêche',
                    'Chasse'=>'Chasse',
                ],
            ])

            ->add('adresse',TextType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('organisateur')

            ->add('num',TextType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('date_debut',DateType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('date_fin',DateType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('nbr_participant_max',IntegerType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('description',TextareaType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))

            ->add('file',FileType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))


//            ->add('nbr_participant',IntegerType::class,array( 'attr' => array('class' => 'form-control','required' => true,)))




        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventsBundle\Entity\Events'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'eventsbundle_events';
    }


}
