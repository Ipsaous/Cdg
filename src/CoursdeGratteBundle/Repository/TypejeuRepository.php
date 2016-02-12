<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TypejeuRepository extends EntityRepository{

    public function findAllOrderedByName(){

        $queryBuilder = $this->createQueryBuilder("t");
        $queryBuilder->from($this->_entityName, 'p')
            ->where('t.id != :id')
            ->orderBy('t.typejeu', 'ASC')
            ->setParameter('id', 9);
        $results = $queryBuilder->getQuery()->getResult();
        return $results;

    }
} 