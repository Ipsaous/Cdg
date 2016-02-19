<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 15/02/2016
 * Time: 16:42
 */

namespace MyUserBundle\Security;


use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Security\UserProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class MyUserProvider extends UserProvider{

    public function __construct(UserManagerInterface $userManagerInterface){
        parent::__construct($userManagerInterface);
    }

    /**
     * Si un utilisateur est inscrit avec mon ancien systeme
     * Rediriger vers le changement de mot de passe
     * @param $username
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function checkOldFashion($username){

        //$array = ["username" => $username, "password" => $password];
        $user = $this->userManager->findUserByUsername($username);
        return $user;
    }


} 