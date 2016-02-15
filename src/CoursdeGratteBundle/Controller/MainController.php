<?php

namespace CoursdeGratteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \CoursdeGratteBundle\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{

    private $limit = 24;
    // TODO Virer la requete ajax de l'indexAction car en faisant un backNavigateur, j'ai l'echo json

    public function indexAction()
    {

        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //Récupération de la liste des profs

        $types_jeu = $em->getRepository('CoursdeGratteBundle:Typejeu')->findAllOrderedByName();
        $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById();
        $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();
        return $this->render('CoursdeGratteBundle:Home:index.html.twig',
            array(
                'profs' => $profs,
                'types_jeu' => $types_jeu,
                'langues' => $langues
            ));
    }

    public function testAction(){
        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //Récupération de la liste des profs

        $types_jeu = $em->getRepository('CoursdeGratteBundle:Typejeu')->findAllOrderedByName();
        $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById();
        $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();
        return $this->render('CoursdeGratteBundle:Home:test.html.twig',
            array(
                'profs' => $profs,
                'types_jeu' => $types_jeu,
                'langues' => $langues
            ));
    }

}
