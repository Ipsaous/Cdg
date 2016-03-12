<?php

namespace CoursdeGratteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType{

    public function buildForm(FormBuilderInterface $form, array $options){

        $form
            ->add("name", TextType::class, array(
                "translation_domain" => false,
            ));
    }

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            "data_class" => 'CoursdeGratteBundle\Entity\Playlist'
        ));

    }

} 