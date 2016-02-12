<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ParamuserRepository extends EntityRepository {

    public function getDefaultLangue($userId)
    {
        $qb = $this->createQueryBuilder("langueId")->from($this->_entityName, "p");
        $qb->where("p.userId = :id")->setParameter("id", $userId);
        return $qb->getQuery()->getSingleResult();
    }

} 