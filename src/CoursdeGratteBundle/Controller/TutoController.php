<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 20/02/2016
 * Time: 00:04
 */

namespace CoursdeGratteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller{

    public function showAction($slug, $id){

        $em = $this->getDoctrine()->getManager();
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->find($id);

        return $this->render("CoursdeGratteBundle:Tuto:index.html.twig",
            array(
                'tuto' => $tuto
            ));

    }

} 