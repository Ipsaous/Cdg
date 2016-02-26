<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 22/02/2016
 * Time: 13:11
 */

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ArtisteRepository extends EntityRepository{

    public function findByName($name){
        $qb = $this->createQueryBuilder("a")
            ->select("a.artiste")->where("a.artiste LIKE :query")->setParameter("query", '%'.$name.'%')
            ->distinct()
            ->getQuery();
        return $results = $qb->getArrayResult();

    }
} 