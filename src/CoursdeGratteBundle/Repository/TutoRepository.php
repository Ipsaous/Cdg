<?php

namespace CoursdeGratteBundle\Repository;

use CoursdeGratteBundle\Entity\Tutovideo;
use Doctrine\ORM\EntityRepository;

class TutoRepository extends EntityRepository {

    public function rawQuery($db, $where, $limit, $offset){

        $query = "SELECT tutovideo.titre, artiste.artiste, difficulty.difficulty, style.style, typeguitare.typeguitare, typejeu.typejeu, tutovideo.slug, langue.id as langueid, tutovideo.lientuto, prof.prof,difficulty.id, tutovideo.id as tutoid, tutovideo.id_typetuto, tutovideo.lientablature FROM tutovideo INNER JOIN style ON style.id = tutovideo.id_style INNER JOIN artiste ON artiste.id = tutovideo.id_artiste INNER JOIN difficulty ON difficulty.id = tutovideo.id_difficulty INNER JOIN typeguitare ON typeguitare.id = tutovideo.id_typeguitare INNER JOIN prof ON prof.id = tutovideo.id_prof INNER JOIN langue ON langue.id = prof.id_langue INNER JOIN typejeu ON typejeu.id = tutovideo.id_typejeu INNER JOIN styletechnique ON styletechnique.id = tutovideo.id_styletechnique INNER JOIN typetuto ON typetuto.id = tutovideo.id_typetuto".$where ." ORDER BY tutovideo.id DESC LIMIT $limit OFFSET $offset";
        $sql = $db->prepare($query);
        $sql->execute();
        $results = $sql->fetchAll();
        return $results;
    }

    public function findByTitle($title){

        $qb = $this->createQueryBuilder("t")
            ->select("t.titre")->where("t.titre LIKE :query")->setParameter("query", '%'.$title.'%')
            ->distinct()
            ->getQuery();
        return $results = $qb->getArrayResult();

    }

    public function findTutoByIdSlug($id, $slug){

        $qb = $this->createQueryBuilder("t")->
        join("t.idArtiste", "artiste")->addSelect("artiste")->
            join("t.idStyle", "style")->addSelect("style")->
            join("t.idProf", "prof")->addSelect("prof")->
            join("t.idTypejeu", "typejeu")->addSelect("typejeu")->
            join("t.idStyletechnique", "styletechnique")->addSelect("styletechnique")->
            join("t.idTypeguitare", "typeguitare")->addSelect("typeguitare")->
            join("t.idTypetuto", "typetuto")->addSelect("typetuto")->
            join("prof.idLangue", "langue")->addSelect("langue")

            ->where("t.id = :id AND t.slug = :slug")->setParameter("id", $id)->setParameter("slug", $slug);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findTutoByArtist($tutoId, $idArtiste, $arrayOfId = []){

        $array = [$tutoId];
        if(count($arrayOfId) > 0){
            for($i = 0; $i < count($arrayOfId); $i++){
                $array[$i+1] = $arrayOfId[$i]->getId();
            }
        }
        $qb = $this->_em->createQueryBuilder();
        $qb->select("t")->from($this->_entityName, 't')->
        join("t.idArtiste", "artiste")->addSelect("artiste")->
        join("t.idStyle", "style")->addSelect("style")->
        join("t.idProf", "prof")->addSelect("prof")->
        join("t.idTypejeu", "typejeu")->addSelect("typejeu")->
        join("t.idStyletechnique", "styletechnique")->addSelect("styletechnique")->
        join("t.idTypeguitare", "typeguitare")->addSelect("typeguitare")->
        join("t.idTypetuto", "typetuto")->addSelect("typetuto")->
        join("prof.idLangue", "langue")->addSelect("langue")->
        where($qb->expr()->notIn('t.id', $array))->
        andWhere("t.idArtiste = :id")->setParameter("id", $idArtiste)->
        orderBy("t.titre", "ASC");
        return $qb->getQuery()->getResult();
    }

    public function findTutoSameSong($id, $title, $idArtiste){

        $qb = $this->createQueryBuilder("t")->
        join("t.idArtiste", "artiste")->addSelect("artiste")->
        join("t.idStyle", "style")->addSelect("style")->
        join("t.idProf", "prof")->addSelect("prof")->
        join("t.idTypejeu", "typejeu")->addSelect("typejeu")->
        join("t.idStyletechnique", "styletechnique")->addSelect("styletechnique")->
        join("t.idTypeguitare", "typeguitare")->addSelect("typeguitare")->
        join("t.idTypetuto", "typetuto")->addSelect("typetuto")->
        join("prof.idLangue", "langue")->addSelect("langue")

            ->where("t.idArtiste = :id")->setParameter("id", $idArtiste)
            ->andWhere("t.titre LIKE :title")->setParameter("title", "%".$title."%")
            ->andWhere("t.id != :tutoId")->setParameter("tutoId", $id)->orderBy("t.titre", "ASC");
        return $qb->getQuery()->getResult();

    }

} 