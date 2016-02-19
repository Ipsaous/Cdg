<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 17/02/2016
 * Time: 17:27
 */

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;
use MyUserBundle\Entity\Users;

class FavorisRepository extends EntityRepository{

    public function findAllByUser(Users $user){

        $qb = $this->createQueryBuilder("f")->where("f.user = :id")->setParameter("id", $user->getId());
        return $qb->getQuery()->getResult();

    }

} 