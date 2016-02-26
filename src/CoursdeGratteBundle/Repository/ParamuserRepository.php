<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class ParamuserRepository extends EntityRepository {

    public function getDefaultLangue($userId)
    {
        $qb = $this->createQueryBuilder("p")->join("p.langueId", "langue")->addSelect("langue")
            ->where("p.userId = :id")->setParameter("id", $userId);
        try{
            return $qb->getQuery()->getSingleResult();
        }catch (NoResultException $e){
            return null;
        }
    }

} 