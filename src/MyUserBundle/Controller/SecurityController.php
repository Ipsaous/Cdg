<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 25/02/2016
 * Time: 15:04
 */

namespace MyUserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Security;

class SecurityController extends BaseController
{

    public function loginAction(Request $request)
    {
        //Je redirige si l'utilisateur est déjà connecté
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirect($this->generateUrl('home'));
        }

        $addButton = false;
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
        if($error instanceof DisabledException){
            $addButton = true;
        }

        //Je renvoie l'email si l'utilisateur n'a pas activé son compte
        $this->resendEmailIsNotEnabled($lastUsername, $request);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'resendButton' => $addButton
        ));
    }

    public function resendEmailIsNotEnabled($username, Request $request){
        if($request->isMethod("POST") && $request->get("_resend") !== null){
            $user = $this->get("fos_user.user_manager")->findUserByUsername($username);
            $mailer = $this->get("fos_user.mailer");
            if($user->getConfirmationToken() !== null) {
                $mailer->sendConfirmationEmailMessage($user);
                $this->addFlash("success", "Un email vient de vous être envoyé. Pensez également à regarder votre dossier Spam");
            }else{
                $this->addFlash("danger", "Il semblerait qu'il y ait un soucis. Veuillez me contactez");
            }
        }
    }

} 