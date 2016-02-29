<?php

namespace CoursdeGratteBundle\Controller;

use CoursdeGratteBundle\Utility\MyUtility;
use Gedmo\Sluggable\Util\Urlizer;
use MyUserBundle\Security\MyPasswordEncoder;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \CoursdeGratteBundle\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MainController extends Controller
{

    public function indexAction(){

        $em = $this->getDoctrine()->getManager();
        //Je récupére l'user
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $defaultLangue = $this->get("session")->get("_defaultLangue");

        if($defaultLangue === null){
            if($this->isGranted("ROLE_USER")){
                $defaultLangue = $em->getRepository("CoursdeGratteBundle:Paramuser")->getDefaultLangue($user->getId());
                if($defaultLangue !== null)
                    $this->get("session")->set("_defaultLangue", $defaultLangue);
            }
        }

        if($defaultLangue !== null) {
            $langueId = $defaultLangue->getLangueId()->getId();
            $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById($langueId);
            $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName($langueId);
        }else{
            $langues = $em->getRepository('CoursdeGratteBundle:Langue')->findAllOrderedById();
            $profs = $em->getRepository('CoursdeGratteBundle:Prof')->findAllOrderedByName();
        }
        $types_jeu = $em->getRepository('CoursdeGratteBundle:Typejeu')->findAllOrderedByName();

        return $this->render('CoursdeGratteBundle:Home:index.html.twig',
            array(
                'profs' => $profs,
                'types_jeu' => $types_jeu,
                'langues' => $langues,
                'default_langue' => $defaultLangue
            ));
    }

    public function testPasswordAction(){

//
//        $user = $um->findUserByUsername("Ipsaous");
//        $favoris = $em->getRepository("CoursdeGratteBundle:Favoris")->findAllByUser($user);
//        $playlist = $em->getRepository("CoursdeGratteBundle:Playlist")->find(1);
//        $tuto = $em->getRepository("CoursdeGratteBundle:Tutovideo")->find(5);
//        $fav = new Entity\Favoris();
//        $fav->setUser($user);
//        $fav->setTuto($tuto);
//        $fav->setPlaylist($playlist);
//        $em->persist($fav);
//        $em->flush();
//        dump("ok");
//        die();
    }

    public function moveUserFromOldToNewDatabaseAction(){
        //Je récupère la connexion à la bdd
        $db = $this->get("database_connection");
        //Je récupère le userManager
        $um = $this->get('fos_user.user_manager');
        //Je récupère l'entityManager
        $em = $this->getDoctrine()->getManager();
        //Je fais ma requete pour chopper les "old" users
        $sql = $db->query("SELECT * FROM old_users LIMIT 10 OFFSET 0");
        //Je récupère l'encoder pour pouvoir convertir les mot de passes
        $encoder = new MyPasswordEncoder();

        //Je boucle pour update la database
        //TODO FAIRE LA MEME CHOSE POUR LES FAVORIS / PLAYLIST / PARAMUSER / TAB_MEMBERS
        //TODO PENSEZ A DESACTIVER L'INCREMENTATION AUTOMATIQUE POUR QUE LES IDS CORRESPONDENT ENTRE LES DIFFERENTES TABLES
        //TODO JUSTE ENLEVER LE IDENTITY DANS L'ENTITY USER ET DANS LE USERS.ORM.XML
        while($oldUser = $sql->fetch(PDO::FETCH_OBJ)){
            $userFOS = $um->createUser();
            $userFOS->addSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
            $userFOS->setId($oldUser->id);
            $userFOS->setUsername($oldUser->username);
            $userFOS->setEmail($oldUser->email);
            $userFOS->setPassword($encoder->refreshOldPassword($oldUser->password, $userFOS->getSalt()));
            $userFOS->setEnabled(1);
            $userFOS->setNewsletterActive($oldUser->newsletter_active);
            $userFOS->setNbrePropositions($oldUser->nbre_propositions);
            $em->persist($userFOS);
            //dump($userFOS);
        }
        $em->flush();
        die();
    }



}
