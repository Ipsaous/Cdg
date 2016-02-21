<?php

namespace CoursdeGratteBundle\Repository;

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

    public function findTutoWithName($db, $id){

        $query = "SELECT tutovideo.titre, tutovideo.nbrvues, artiste.id as artisteid, artiste.artiste, difficulty.difficulty, style.style, typeguitare.typeguitare, typejeu.typejeu, tutovideo.slug, langue.langue, tutovideo.lientuto, tutovideo.liendemo, prof.prof, difficulty.id, tutovideo.partie2, tutovideo.partie3, tutovideo.partie4, tutovideo.partie5, tutovideo.partie6, tutovideo.partie7, tutovideo.partie8, tutovideo.partie9, tutovideo.partie10, tutovideo.lientablature, prof.siteprof, tutovideo.id as tutoid, styletechnique.styletechnique, style.id as styleid, tutovideo.id_typetuto as typetutoid, styletechnique.id as styletechniqueid, prof.id as profid FROM tutovideo INNER JOIN style ON style.id = tutovideo.id_style INNER JOIN artiste ON artiste.id = tutovideo.id_artiste INNER JOIN difficulty ON difficulty.id = tutovideo.id_difficulty INNER JOIN typeguitare ON typeguitare.id = tutovideo.id_typeguitare INNER JOIN prof ON prof.id = tutovideo.id_prof INNER JOIN langue ON langue.id = prof.id_langue INNER JOIN typejeu ON typejeu.id = tutovideo.id_typejeu INNER JOIN typetuto ON typetuto.id = tutovideo.id_typetuto INNER JOIN styletechnique ON styletechnique.id = tutovideo.id_styletechnique WHERE tutovideo.id = :id";
        $sql = $db->prepare($query);
        $sql->execute(array(":id" => $id));
        $result = $sql->fetch();
        return $result;


    }

    public function rawQuery($db, $where, $limit, $offset){

        $query = "SELECT tutovideo.titre, artiste.artiste, difficulty.difficulty, style.style, typeguitare.typeguitare, typejeu.typejeu, tutovideo.slug, langue.langue, tutovideo.lientuto, prof.prof,difficulty.id, tutovideo.id as tutoid, tutovideo.id_typetuto, tutovideo.lientablature FROM tutovideo INNER JOIN style ON style.id = tutovideo.id_style INNER JOIN artiste ON artiste.id = tutovideo.id_artiste INNER JOIN difficulty ON difficulty.id = tutovideo.id_difficulty INNER JOIN typeguitare ON typeguitare.id = tutovideo.id_typeguitare INNER JOIN prof ON prof.id = tutovideo.id_prof INNER JOIN langue ON langue.id = prof.id_langue INNER JOIN typejeu ON typejeu.id = tutovideo.id_typejeu INNER JOIN styletechnique ON styletechnique.id = tutovideo.id_styletechnique INNER JOIN typetuto ON typetuto.id = tutovideo.id_typetuto".$where ." ORDER BY tutovideo.id DESC LIMIT $limit OFFSET $offset";
        $sql = $db->prepare($query);
        $sql->execute();
        $results = $sql->fetchAll();
        return $results;
    }

    public function test($id){

        $qb = $this->createQueryBuilder("t")->join("t.idArtiste", "artistes")->addSelect("artistes")
            ->where("t.id = :id")->setParameter("id", $id);
        return $qb->getQuery()->getSingleResult();
    }

} 