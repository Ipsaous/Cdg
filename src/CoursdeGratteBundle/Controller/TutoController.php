<?php

namespace CoursdeGratteBundle\Controller;


use CoursdeGratteBundle\Entity\Favoris;
use CoursdeGratteBundle\Entity\Playlist;
use CoursdeGratteBundle\Entity\Tutovideo;
use CoursdeGratteBundle\Form\FavorisType;
use CoursdeGratteBundle\Form\PlaylistType;
use CoursdeGratteBundle\Utility\MyUtility;
use Doctrine\ORM\EntityManager;
use MyUserBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TutoController extends Controller{

    public function showAction($slug, $id, Request $request){

        //Je récupère l'user
        $user = $this->getUser();
//        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_REMEMBERED")){
//
//        }

        //Récupération du tuto
        $id = (int) $id; // Déjà vérifier en regex dans le routing. Voir ce que ça donne
        $em = $this->getDoctrine()->getManager();
        $tutoRepository = $em->getRepository("CoursdeGratteBundle:Tutovideo");
        $tuto = $tutoRepository->findTutoByIdSlug($id, $slug);

        if($tuto === null){
            throw $this->createNotFoundException('Le tuto demandé n\'existe pas ');
        }

        $tutoSameArtist = [];
        $tutoSameSong = [];

        //Je récupère les chansons d'un meme artiste
        if($tuto->getIdTypetuto()->getId() === 1){
            $tutoSameSong = $tutoRepository->findTutoSameSong($tuto->getId(), $tuto->getTitre(), $tuto->getIdArtiste()->getId());
            $tutoSameArtist = $tutoRepository->findTutoByArtist($tuto->getId(), $tuto->getIdArtiste()->getId(), $tutoSameSong);
        }
        //Récupération des liens pour gérer les différentes parties
        $videoLinks = $this->getVideoLink($tuto);
        //Récupération de la description Youtube
        $description = MyUtility::getDescriptionYoutube($tuto->getLientuto(), $tuto->getTitre(), $tuto->getIdArtiste()->getArtiste());


        //Récupération des playlist et ajout a l'utilisateur
        $this->getPlaylist($em);

        //Je check si j'ai déjà rajouté le favoris dans une playlist
        $isAlreadyInFav = $this->checkIfAlreadyInFavs($id);
        if($isAlreadyInFav !== null){
            $favoris = $isAlreadyInFav["favoris"];
        }else{
            $favoris = new Favoris();
        }

        //Création des formulaires
        $favorisForm = $this->createForm(FavorisType::class, $favoris);
        $playlist = new Playlist();
        $playlistForm = $this->createForm(PlaylistType::class, $playlist);

        //TODO Relancer l'idée d'un deuxieme formulaire pour l'ajout d'une playlist
        if($request->isMethod("POST")){

            //Si j'ai playlist dans la request, c'est la création d'une playlist
            if($request->get("playlist") !== null
                && trim($request->get("playlist")['name']) !== "") {

                $playlistForm->handleRequest($request);
                $json = $this->addPlaylist($playlistForm, $request, $tuto, $playlist, $favoris, $em, $user);
                return new JsonResponse($json);

            }else {
                $favorisForm->handleRequest($request);
                $json = $this->changePlaylist($favorisForm, $request, $favoris, $user, $tuto, $em);
                return new JsonResponse($json);
            }
        }

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto,
                'videoLinks' => $videoLinks,
                'description' => $description,
                'tutoSameArtist'=> $tutoSameArtist,
                'tutoSameSong' => $tutoSameSong,
                'alreadyInFav' => $isAlreadyInFav,
                'favorisForm' => $favorisForm->createView(),
                'playlistForm' => $playlistForm->createView()
            ));
    }

    /**
     * //TODO NON UTILISEE POUR LE MOMENT
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
        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
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
        if($this->get("security.authorization_checker")->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            $array = [];
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $favoris = $em->getRepository("CoursdeGratteBundle:Favoris")->findAllByUser($user->getId());
            foreach($favoris as $fav){
                if($fav->getTuto()->getId() === $tutoId){
                    $playlist = $fav->getPlaylist();
                    return $array = ["favoris" => $fav, "playlist" => $playlist];

                }
            }
        }
        return null;
    }

    /**
     * Création d'une nouvelle playlist
     * @param $form
     * @param Request $request
     * @param Tutovideo $tuto
     * @param Playlist $playlist
     * @param Favoris $favoris
     * @param EntityManager $em
     * @param Users $user
     * @return array
     */
     public function addPlaylist($form, Request $request, Tutovideo $tuto, Playlist $playlist, Favoris $favoris, EntityManager $em, Users $user){

        if ($form->isValid()) {
            //Récupération du nom de la playlist et creation
            $playlistName = $request->get("playlist")["name"];
            $playlist->setName($playlistName);
            $playlist->setUser($user);
            $em->persist($playlist);

            //Création du favoris
            $favoris->setPlaylist($playlist);
            $favoris->setUser($user);
            $favoris->setTuto($tuto);
            $em->persist($favoris);

            //Rajout du favoris et de la playlist a l'user
            $user->addPlaylist($playlist);
            $user->addFavoris($favoris);

            //Flush de l'ensemble
            $em->flush();

            //Récupération du dernier id de la playlist
            $id = $playlist->getId();
            //Création du retour json
            $json = ["playlist" => array("id" => $id, "name" => $playlist->getName()), "message" => "Favoris Ajouté"];

        }else{
            $errors = $form->getErrors(true, true)->__toString();
            $json = ["error" => $errors];
        }

        return $json;

    }

    /**
     * Rajout d'un favoris dans une playlist existante
     * @param $form
     * @param Request $request
     * @param Favoris $favoris
     * @param Users $user
     * @param Tutovideo $tuto
     * @param EntityManager $em
     * @return array
     */
    public function changePlaylist($form, Request $request, Favoris $favoris, Users $user, Tutovideo $tuto, EntityManager $em){
        if ($form->isValid()) {
            //Récupération de mes playlist en fonction de son id dans la requete
            $playlist = $em->getRepository("CoursdeGratteBundle:Playlist")->find($request->get("favoris")['playlist']);
            if ($playlist !== null && $user !== null) { // Le tuto ne peux pas être null car je renvois une exception

                $favoris->setPlaylist($playlist);
                $favoris->setUser($user);
                $favoris->setTuto($tuto);
                $em->persist($favoris);
                $em->flush();
                $json = ["message" => "Favoris ajouté"];
            }else{
                $json = ["error" => "Une Valeur est nulle alors qu'elle ne devrais pas l'etre :D"];
            }
        }else {
            //TODO GERER LES ERREURS
            $errors = $form->getErrors(true, true);
            $errorCollection = array();
            foreach ($errors as $error) {
                $errorCollection[] = $error->getMessageTemplate();
            }
            $json = ["error" => "Une erreur s'est produite" ];
        }

        return $json;
    }



} 