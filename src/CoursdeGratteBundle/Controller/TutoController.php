<?php

namespace CoursdeGratteBundle\Controller;


use CoursdeGratteBundle\Entity\Tutovideo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller{

    public function showAction($slug, $id){

        //Je récupère l'user
        //$user = $this->get("security.token_storage")->getToken()->getUser();

        $id = (int) $id;
        $em = $this->getDoctrine()->getManager();
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findTutoByIdSlug($id, $slug);
        if($tuto !== null){
            $videoLinks = $this->getVideoLink($tuto);
        }else{
            throw new \Exception("Page Introuvable. Il Semblerait que ce tuto n'existe plus");
        }

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto,
                'videoLinks' => $videoLinks
            ));
    }

    public function getVideoLink(Tutovideo $tuto){

        $parts = ["Lientuto", "Liendemo", "Partie2", "Partie3", "Partie4", "Partie5", "Partie6", "Partie7", "Partie8",
        "Partie9", "Partie10"];
        $final = [];
        foreach($parts as $part){
            $get = "get".$part;
            if($tuto->$get() !== ""){
                if($part === "Lientuto"){
                    $part = "Tuto";
                }
                if($part === "Liendemo"){
                    $part = "Démo";
                }
                $final[$part] = $tuto->$get();
            }
        }
        return $final;

    }

} 