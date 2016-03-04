<?php

namespace MyUserBundle\EventListener;


use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashListener implements EventSubscriberInterface{

    private $session;
    private $translator;

    public function __construct(Session $session, TranslatorInterface $translator){
        $this->session = $session;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'removeFlash',

        );
    }

    public function removeFlash(){

    }
}