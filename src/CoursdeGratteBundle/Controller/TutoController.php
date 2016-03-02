<?php

namespace CoursdeGratteBundle\Controller;


use CoursdeGratteBundle\Entity\Tutovideo;
use CoursdeGratteBundle\Utility\MyUtility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller{

    public function showAction($slug, $id){

        //Je récupère l'user
        //$user = $this->get("security.token_storage")->getToken()->getUser();

        $id = (int) $id;
        $em = $this->getDoctrine()->getManager();
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findTutoByIdSlug($id, $slug);
        $description = "";
        if($tuto !== null){
            $videoLinks = $this->getVideoLink($tuto);
            $description = MyUtility::getDescriptionYoutube($tuto->getLientuto());
        }else{
            throw new \Exception("Page Introuvable. Il Semblerait que ce tuto n'existe plus");
        }

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto,
                'videoLinks' => $videoLinks,
                'description' => $description
            ));
    }

    public function suggestionsAction($profId){
        $em = $this->getDoctrine()->getManager();
        $tutos = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findBy(array('idProf' => $profId), null, 5, 0);
        return $this->render("partials/vignette.html.twig", array('tutos' => $tutos));
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