<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 12/02/2016
 * Time: 02:12
 */

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class StyleRepository extends EntityRepository{

    public function findStyleWithTypeTuto(){

        $query = $this->_em->createQuery("SELECT s.id, s.style FROM CoursdeGratteBundle:Style s WHERE s.id != :id ORDER BY s.style ");
        $query->setParameter('id', 19);
        return $query->getArrayResult();

    }

} 