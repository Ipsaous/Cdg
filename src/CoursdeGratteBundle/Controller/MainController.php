<?php

namespace CoursdeGratteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \CoursdeGratteBundle\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{
    public function indexAction(Request $request)
    {

        if($request->isXmlHttpRequest()){
            $data = $this->newHandle($request);
            return new JsonResponse(['data' => $data]);
        }
        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //Récupération de la liste des profs

        $types_jeu = $em->getRepository('CoursdeGratteBundle:Typejeu')->findAllOrderedByName();
        $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById();
        $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();


        $tutos = $em->getRepository('CoursdeGratteBundle:Tutovideo')->myFindAll(0, 24);
        return $this->render('CoursdeGratteBundle:Home:index.html.twig',
            array(
                'tutos' => $tutos,
                'profs' => $profs,
                'types_jeu' => $types_jeu,
                'langues' => $langues
            ));
    }

    public function ajaxAction(Request $request){

        if($request->isXmlHttpRequest()){

            if($request->get("langue") !== null){
                $em = $this->getDoctrine()->getManager();
                $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findProfsWithLangue($request->get("langue"));
                return new JsonResponse(['profs' => $profs]);
            }

        }



    }


    public function newHandle(Request $request){
        $where = "";
        $filters = ["difficulty", "style", "prof", "typeguitare", "typejeu", "langue", "tablature", "typetuo"];
        foreach($filters as $filter){
            $value = $request->get($filter);
            if(is_numeric($value)) {
                //Si la cle GET n'existe pas ça retourne null
                if ($value !== null) {
                    if ($filter == 'tablature') {
                        if (empty($value)) {
                            $tablature = '(lientablature != "" OR lientablature = "")';
                        }
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
        $db = $this->get("database_connection");
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('CoursdeGratteBundle:Tutovideo')->rawQuery($db, $where, 24, 0);

        return $results;

    }

}
