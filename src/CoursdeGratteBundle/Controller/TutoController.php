<?php

namespace CoursdeGratteBundle\Controller;


use CoursdeGratteBundle\Entity\Favoris;
use CoursdeGratteBundle\Entity\Playlist;
use CoursdeGratteBundle\Entity\Tutovideo;
use CoursdeGratteBundle\Form\FavorisType;
use CoursdeGratteBundle\Form\PlaylistType;
use CoursdeGratteBundle\Utility\MyUtility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TutoController extends Controller{

    public function showAction($slug, $id){

        //Je récupère l'user
        //$user = $this->getUser();
//        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_FULLY")){
//
//        }

        $id = (int) $id;
        $em = $this->getDoctrine()->getManager();
        $tutoRepository = $em->getRepository("CoursdeGratteBundle:Tutovideo");
        $tuto = $tutoRepository->findTutoByIdSlug($id, $slug);
        $description = "";
        $tutoSameArtist = [];
        $tutoSameSong = [];

        //Récupération des playlist et ajout a l'utilisateur
        $this->getPlaylist($em);

        //Je check si j'ai déjà rajouté le favoris dans une playlist

        $isAlreadyInFav = $this->checkIfAlreadyInFavs($id);

        if($tuto !== null){
            //Je récupère les chansons d'un meme artiste
            if($tuto->getIdTypetuto()->getId() === 1){
                $tutoSameSong = $tutoRepository->findTutoSameSong($tuto->getId(), $tuto->getTitre(), $tuto->getIdArtiste()->getId());
                $tutoSameArtist = $tutoRepository->findTutoByArtist($tuto->getId(), $tuto->getIdArtiste()->getId(), $tutoSameSong);
            }
            //Récupération des liens pour gérer les différentes parties
            $videoLinks = $this->getVideoLink($tuto);
            //Récupération de la description Youtube
            $description = MyUtility::getDescriptionYoutube($tuto->getLientuto(), $tuto->getTitre(), $tuto->getIdArtiste()->getArtiste());

        }else{
            throw new NotFoundHttpException("Page Introuvable. Il Semblerait que ce tuto n'existe plus");
        }

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto,
                'videoLinks' => $videoLinks,
                'description' => $description,
                'tutoSameArtist'=> $tutoSameArtist,
                'tutoSameSong' => $tutoSameSong,
                'alreadyInFav' => $isAlreadyInFav
            ));
    }

    /**
     * Récupération des suggestions
     * @param $profId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function suggestionsAction($profId){
        $em = $this->getDoctrine()->getManager();
        $tutos = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findBy(array('idProf' => $profId), null, 5, 0);
        return $this->render("partials/vignette.html.twig", array('tutos' => $tutos));
    }

    /**
     * Récupération des liens Vidéo pour gérer les différentes parties
     * @param Tutovideo $tuto
     * @return array
     */
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

    /**
     * Récupération des playlists d'un user
     * @param $em
     */
    public function getPlaylist($em){
        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_FULLY")) {
            $user = $this->getUser();
            $playlists = $em->getRepository("CoursdeGratteBundle:Playlist")->findAllByUser($user->getId());
            foreach ($playlists as $playlist) {
                $user->addPlaylist($playlist);
            }
        }
    }

    /**
     * Vérification des favoris pour voir si ils sont déjà dans une playlist
     * @param $tutoId
     * @return null
     */
    public function checkIfAlreadyInFavs($tutoId){
        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_FULLY")) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $favoris = $em->getRepository("CoursdeGratteBundle:Favoris")->findAllByUser($user->getId());
            foreach($favoris as $fav){
                if($fav->getTuto()->getId() === $tutoId){
                    $playlist = $fav->getPlaylist();
                    return $playlist;
                }
            }
        }
        return null;
    }

} 