<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TutoRepository extends EntityRepository {

    public function myFindAll($offset, $limit)
    {
        $queryBuilder = $this->createQueryBuilder("t");
        $queryBuilder->from($this->_entityName, 'tuto')
            ->setFirstResult( $offset )
            ->setMaxResults( $limit );
        $results = $queryBuilder->getQuery()->getResult();
        return $results;
    }


} 