<?php

namespace MyUserBundle\Security;


use CoursdeGratteBundle\Repository\ParamuserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    private $router;
    private $paramuserRepository;
    private $session;

    public function __construct(Router $router, ParamuserRepository $paramuserRepository, Session $session){
        $this->router = $router;
        $this->paramuserRepository = $paramuserRepository;
        $this->session = $session;
    }
    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        $defaultLangue = $this->paramuserRepository->getDefaultLangue($user->getId());
        if($defaultLangue !== null){
            //Si j'ai une langue par défaut, je la met en session
            $this->session->set("_defaultLangue", $defaultLangue);
        }
        return $response = new RedirectResponse($this->router->generate("home"));
    }
}