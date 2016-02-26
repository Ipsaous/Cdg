<?php

namespace CoursdeGratteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller{

    public function showAction($slug, $id){

        //Je récupère l'user
        //$user = $this->get("security.token_storage")->getToken()->getUser();

        $id = (int) $id;
        $db = $this->get("database_connection");
        $em = $this->getDoctrine()->getManager();
        //$tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findTutoWithName($db, $id);
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->test($id);
//        $idDiff = $tuto->getIdDifficulty()->getId();
//        dump($tuto, $idDiff);
//        die();
        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto
            ));
    }

} 