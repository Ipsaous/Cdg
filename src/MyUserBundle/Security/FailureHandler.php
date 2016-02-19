<?php


namespace MyUserBundle\Security;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;


class FailureHandler implements AuthenticationFailureHandlerInterface {

    private $router;
    private $userManager;

    public function __construct(Router $router, UserManagerInterface $userManager)
    {
        $this->router = $router;
        $this->userManager = $userManager;
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
        // TODO: Implement onAuthenticationFailure() method.
        $username = $request->get("_username");
        $password = $request->get("_password");
        $encoder = new MyPasswordEncoder();
        $user = $this->userManager->findUserByUsername($username);
        $valid = $encoder->isPasswordValid($user->getPassword(), $password, $encoder->encodePassword($password, $user->getSalt()));
        dump($valid, $encoder->encodePassword($password, $user->getSalt()), $user);
        die();

        //return new RedirectResponse($this->router->generate('fos_user_security_login'));
    }

}