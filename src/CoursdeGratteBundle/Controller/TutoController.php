<?php

namespace CoursdeGratteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller{

    public function showAction($slug, $id){

        $id = (int) $id;
        $db = $this->get("database_connection");
        $em = $this->getDoctrine()->getManager();
        //$tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findTutoWithName($db, $id);
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->test($id);
//        $artiste = $tuto->getIdArtiste();
//        $artiste->setTuto($tuto);
//        dump($tuto);
//        die();
        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto
            ));
    }

} 