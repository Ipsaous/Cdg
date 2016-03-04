<?php

namespace CoursdeGratteBundle\Controller;


use CoursdeGratteBundle\Entity\Tutovideo;
use CoursdeGratteBundle\Utility\MyUtility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TutoController extends Controller{

    public function showAction($slug, $id){

        //Je récupère l'user
        //$user = $this->get("security.token_storage")->getToken()->getUser();

        $id = (int) $id;
        $em = $this->getDoctrine()->getManager();
        $tutoRepository = $em->getRepository("CoursdeGratteBundle:Tutovideo");
        $tuto = $tutoRepository->findTutoByIdSlug($id, $slug);
        $description = "";
        $tutoSameArtist = [];
        $tutoSameSong = [];

        if($tuto !== null){
            //Je récupère les chansons d'un meme artiste
            if($tuto->getIdTypetuto()->getId() === 1){
                $tutoSameSong = $tutoRepository->findTutoSameSong($tuto->getId(), $tuto->getTitre(), $tuto->getIdArtiste()->getId());
                $tutoSameArtist = $tutoRepository->findTutoByArtist($tuto->getId(), $tuto->getIdArtiste()->getId(), $tutoSameSong);

//                dump($tutoSameArtist);
//                dump($tutoSameSong);
//                die();
            }
            $videoLinks = $this->getVideoLink($tuto);
            $description = MyUtility::getDescriptionYoutube($tuto->getLientuto());
        }else{
            throw new NotFoundHttpException("Page Introuvable. Il Semblerait que ce tuto n'existe plus");
        }

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto,
                'videoLinks' => $videoLinks,
                'description' => $description,
                'tutoSameArtist'=> $tutoSameArtist,
                'tutoSameSong' => $tutoSameSong
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