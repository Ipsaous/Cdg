<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 12/02/2016
 * Time: 02:14
 */

namespace CoursdeGratteBundle\Repository;


use Doctrine\ORM\EntityRepository;

class StyletechniqueRepository extends EntityRepository{

    public function findStyleWithTypeTuto(){

        $query = $this->_em->createQuery("SELECT s.id, s.styletechnique FROM CoursdeGratteBundle:Styletechnique s WHERE s.id != :id ORDER BY s.styletechnique ");
        $query->setParameter("id", 11);
        return $query->getArrayResult();

    }


} 