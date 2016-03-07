<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 17/02/2016
 * Time: 17:50
 */

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PlaylistRepository extends EntityRepository{

    /**
     * Récupère les playlist d'un utilisateur ainsi que la playlist par défaut
     * @param $id
     * @return array
     */
    public function findAllByUser($id){

        $qb = $this->createQueryBuilder("p")
            ->where("p.user = :user")
            ->setParameter("user", $id)
            ->orWhere("p.id = :id")
            ->setParameter("id", 1);

        return $qb->getQuery()->getResult();

    }

} 