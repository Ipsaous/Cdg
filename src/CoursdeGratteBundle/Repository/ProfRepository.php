<?php

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProfRepository extends EntityRepository{

    public function findAllOrderedByName($langueId = null){

        if($langueId === null){
            $queryBuilder = $this->createQueryBuilder("p")->orderBy('p.prof', 'ASC');
        }else{
            $queryBuilder = $this->createQueryBuilder("p")->where("p.idLangue = :id")
                ->setParameter("id", $langueId)->orderBy("p.prof", "ASC");
        }
        $results = $queryBuilder->getQuery()->getArrayResult();
        return $results;

    }

    public function findProfsWithLangue($id){

        $query = $this->_em->createQuery("SELECT p.id, p.prof FROM CoursdeGratteBundle:Prof p WHERE p.idLangue = :id ORDER BY p.prof");
        $query->setParameter('id', $id);
        return $query->getArrayResult();

    }

    public function findByName($name){
            $qb = $this->createQueryBuilder("p")
                ->select("p.prof")->where("p.prof LIKE :query")->setParameter("query", '%'.$name.'%')
                ->distinct()
                ->getQuery();
            return $results = $qb->getArrayResult();

    }
} 