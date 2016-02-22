<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 15/02/2016
 * Time: 15:18
 */

namespace CoursdeGratteBundle\Controller;

use Doctrine\DBAL\Types\JsonArrayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class AjaxController extends Controller{

    /**
     * Lance la requête pour récupérer tous les tutos
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxAction(Request $request){
        if($request->isMethod("get")){
            $data = $this->handleAjaxTuto($request);
            return new JsonResponse(['data' => $data]);
        }
        if($request->isXmlHttpRequest()){
            $data = $this->handleAjaxTuto($request);
            return new JsonResponse(['data' => $data]);
        }
    }

    /**
     * Methode permettant de gérer l'appel ajax en fonction des différents choix de filtres
     * @param Request $request
     * @return mixed
     */
    public function handleAjaxTuto(Request $request){

        $offset = 0;
        $limit = 24;
        $where = $this->buildWhereInRequest($request);
        if($request->get("offset") !== null && $request->get("limit") !== null){
            $offset = (int) $request->get("offset");
        }
        $db = $this->get("database_connection");
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('CoursdeGratteBundle:Tutovideo')->rawQuery($db, $where, $limit, $offset);

        return $results;

    }

    /**
     * Permet de générer le where dans la requete filtrée
     * @param Request $request
     * @return string where
     */
    public function buildWhereInRequest(Request $request){

        $where = "";
        //Partie qui s'occupe de la fonction rechercher
        if($request->get("query") !== null && $request->get("query") != ""){
            if(preg_match("/^[a-zA-Z0-9 '&âêîïëàèùé]+$/", $request->get("query"))) {
                $query = $request->get("query");
                $where = ' WHERE (artiste.artiste LIKE "%' . $query . '%" OR tutovideo.titre LIKE "%' . $query . '%" OR prof.prof LIKE "%' . $query . '%")';
            }
        }
        $filters = ["difficulty", "style", "prof", "typeguitare", "typejeu", "langue", "tablature", "typetuto"];
        foreach($filters as $filter){
            $value = $request->get($filter);
            if(is_numeric($value)) {
                //Si la cle GET n'existe pas ça retourne null
                if ($value !== null) {
                    if ($filter == 'tablature') {
                        if ($value == 1) {
                            $tablature = 'lientablature != ""';
                        }
                        if ($where !== "") {
                            $where .= " AND $tablature";
                        } else {
                            $where .= " WHERE $tablature";
                        }

                    } else {
                        //Cas pour les 2 styles de tutos différents
                        if (isset($typeTuto) AND $typeTuto == 2 AND $filter == "style") {
                            $filter = "styletechnique";
                        }

                        //Cas général
                        if ($where !== "") {
                            $where .= " AND $filter.id = " . $value;
                        } else {
                            $where = " WHERE $filter.id = " . $value;
                        }
                    }
                }
            }
        }

        return $where;

    }


    /**
     * Lance un requête pour récupérer les profs en fonction de la langue
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxProfAction(Request $request){

        if($request->isXmlHttpRequest()){

            if($request->get("langue") !== null){
                $em = $this->getDoctrine()->getManager();
                if($request->get("langue") !== ""){
                    $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findProfsWithLangue($request->get("langue"));
                }else{
                    $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();
                }
                return new JsonResponse(['profs' => $profs]);
            }

        }
    }

    /**
     * Lance un requête pour récupérer les styles en fonction du type de tuto
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxStyleAction(Request $request){

        if($request->isXmlHttpRequest()){

            if($request->get("typetuto") !== null){
                $em = $this->getDoctrine()->getManager();
                if($request->get("typetuto") === "1") {
                    $styles = $em->getRepository('CoursdeGratteBundle:Style')->findStyleWithTypeTuto();
                    return new JsonResponse(["styles" => $styles]);
                }else if($request->get("typetuto") === "2"){
                    $styles = $em->getRepository('CoursdeGratteBundle:Styletechnique')->findStyleWithTypeTuto();
                    return new JsonResponse(["stylestechniques" => $styles]);
                }

            }

        }
    }

    /**
     * récupères les données pour typeahead
     * @param Request $request
     * @return JsonResponse
     */
    public function typeaheadAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        //if($request->isXmlHttpRequest()) {
            if ($request->get("titre") !== null) {

                $titles = $em->getRepository("CoursdeGratteBundle:Tutovideo")->findByTitle($request->get("titre"));
                //$titres = ["salut", "what", "the", "fuck"];

                return new JsonResponse($titles);

            }elseif($request->get("prof") !== null){
                $em = $this->getDoctrine()->getManager();
                $profs = $em->getRepository("CoursdeGratteBundle:Prof")->findByName($request->get("prof"));
                return new JsonResponse($profs);
            }
        //}
    }
} 