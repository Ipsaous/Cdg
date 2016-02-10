<?php

namespace CoursdeGratteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \CoursdeGratteBundle\Entity;


class MainController extends Controller
{
    public function indexAction()
    {

        //If ajax
        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $langueId = $em->getRepository('CoursdeGratteBundle:Paramuser')->getDefaultLangue(30);

        dump($langueId);
        die();
        $tutos = $em->getRepository('CoursdeGratteBundle:Tutovideo')->myFindAll(0, 24);
        foreach($tutos as $tuto){
            $tuto->setArtisteName($tuto->getIdArtiste()->getArtiste());
            $tuto->setProfName($tuto->getIdProf()->getProf());
        }

        return $this->render('CoursdeGratteBundle:Home:index.html.twig', array('tutos' => $tutos));
    }

    public function getLangueId($userId){

        $em = $this->getDoctrine()->getManager();
        $langueId = $em->getRepository('CoursdeGratteBundle:Paramuser')->getDefaultLangue($userId);
        return $langueId;
    }
}
