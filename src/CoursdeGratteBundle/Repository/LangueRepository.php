<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class LangueRepository extends EntityRepository{

    public function findAllOrderedById($langueId = null){

        if($langueId === null){
            $qb = $this->createQueryBuilder('l')->orderBy("l.id", "ASC");
            return $qb->getQuery()->getResult();
        }else{
            $qb = $this->createQueryBuilder("l")->where("l.id = :id")
                ->setParameter("id", $langueId);
            return $qb->getQuery()->getSingleResult();
        }
    }

} 