<?php

namespace CoursdeGratteBundle\Controller;

use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \CoursdeGratteBundle\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{

    public function indexAction()
    {

        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //Récupération de la liste des profs

        $types_jeu = $em->getRepository('CoursdeGratteBundle:Typejeu')->findAllOrderedByName();
        $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById();
        $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();
        return $this->render('CoursdeGratteBundle:Home:home.html.twig',
            array(
                'profs' => $profs,
                'types_jeu' => $types_jeu,
                'langues' => $langues
            ));
    }

    public function testPasswordAction(){
        /*$um = $this->get('fos_user.user_manager');
        /*$db = $this->get("database_connection");
        $query = "SELECT * FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $em = $this->getDoctrine()->getManager();
        $users = $um->findUsers();
        foreach($users as $user){
            $user->addSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
            /*if($user->getUsernameCanonical() === "" && $user->getEmailCanonical() === ""){

                $um->updateCanonicalFields($user);
                $em->persist($user);
            }
        }
        $em->flush();

        dump("ok");
        die();*/

        $db = $this->get("database_connection");
        $um = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();
        /*$sql = $db->query("SELECT * FROM old_users");

        //$oldUsers = $sql->fetchAll();

        while($oldUser = $sql->fetch(PDO::FETCH_OBJ)){
            //$this->insertPlaylist($db, $oldUser->id);
            //$this->insertFavoris($db, $oldUser->id);
            $userFOS = $um->createUser();

            $userFOS->setId($oldUser->id);
            $userFOS->setUsername($oldUser->username);
            $userFOS->setEmail($oldUser->email);
            $userFOS->setPassword($oldUser->password);
            $userFOS->setEnabled(1);

            $em->persist($userFOS);

        }
        $em->flush();
        die();*/

        //Test ajout d'un favoris

        $user = $um->findUserByUsername("Ipsaous");
        $favoris = $em->getRepository("CoursdeGratteBundle:Favoris")->findAllByUser($user);
        $playlist = $em->getRepository("CoursdeGratteBundle:Playlist")->find(1);
        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->find(5);
        $fav = new Entity\Favoris();
        $fav->setUser($user);
        $fav->setTuto($tuto);
        $fav->setPlaylist($playlist);
        $em->persist($fav);
        $em->flush();
        dump("ok");
        die();
    }



}
