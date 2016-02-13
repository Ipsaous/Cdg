<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class LangueRepository extends EntityRepository{

    public function findAllOrderedById(){

        $qb = $this->createQueryBuilder('a');
        $qb->from($this->_entityName, 'l')->orderBy("a.id", "ASC");

        return $qb->getQuery()->getResult();

    }

} 