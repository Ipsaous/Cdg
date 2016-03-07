<?php

namespace CoursdeGratteBundle\Form;

use CoursdeGratteBundle\Repository\PlaylistRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class FavorisType extends AbstractType
{

    private $token;

    public function __construct(TokenStorage $token){
        $this->token = $token;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $userId = $this->token->getToken()->getUser()->getId();
        $builder
            ->add('playlist', EntityType::class , array(
                'class' => 'CoursdeGratteBundle:Playlist',
                'query_builder' => function(PlaylistRepository $repo) use ($userId){
                    return $repo->findAllByUser($userId);
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoursdeGratteBundle\Entity\Favoris'
        ));
    }
}
