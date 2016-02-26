<?php


namespace MyUserBundle\Security;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Tests\Controller;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;


class FailureHandler implements AuthenticationFailureHandlerInterface {

    private $router;
    private $userManager;
    private $session;

    public function __construct(Router $router, UserManagerInterface $userManager, Session $session)
    {
        $this->router = $router;
        $this->userManager = $userManager;
        $this->session = $session;
    }
    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return Response The response to return, never null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
//        if($exception instanceof DisabledException) {
//            $username = $request->get("_username");
//            $user = $this->userManager->findUserByUsername($username);
//            return new RedirectResponse($this->router->generate('resend', array('email' => $user->getEmail())), 307);
//
//        }


    }

}