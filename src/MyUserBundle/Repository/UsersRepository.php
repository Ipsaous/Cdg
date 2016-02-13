<?php

namespace MyUserBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository{

    /**
     * Si un utilisateur est inscrit avec mon ancien systeme
     * Rediriger vers le changement de mot de passe
     */
    public function checkOldFashion($username, $password){

        $salt1 = "PROTECTIONMOTDEPASSE1";
        $salt2 = "PROTECTIONMOTDEPASSE2";

        $qb = $this->_em->createQueryBuilder("a")->where("username = :username")->andWhere("password = :password");
        $qb->setParameter("username",$username)->setParameter("password", sha1($salt1.$password.$salt2));
        $qb->getQuery()->getResult();

    }

}