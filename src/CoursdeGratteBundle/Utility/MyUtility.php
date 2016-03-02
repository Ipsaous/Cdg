<?php
/**
 * Created by PhpStorm.
 * User: ipsaous
 * Date: 24/02/2016
 * Time: 12:35
 */

namespace CoursdeGratteBundle\Utility;


use Gedmo\Sluggable\Util\Urlizer;

class MyUtility {

    public static function createSlug($prof, $titre){

        $slug = Urlizer::urlize($prof, "-") ."/" . Urlizer::urlize($titre, "-");
        return $slug;

    }

    public static function isStringValid($string){
    	if(!preg_match("/^[a-zA-Z0-9\-\/ .'&âêôüîçïëàèùé?!]+$/", $string)){
    		return false;
    	}
    	return true;
    }

    public static function getDescriptionYoutube($idYoutube){
        //récupération de la description via youtube
        $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$idYoutube."&key=AIzaSyDGo5E2hMOmCbgkRqFExpiN9LtcN5DDtkA");
        $data = json_decode($JSON);
        //var_dump($data);
        $testItem = $data->items; // Pour vérifier que l'on a une description ( que l'id de la video existe quoi)
        if(!empty($testItem)){
            $data = $data ->items[0]->snippet->description;
            $content = $data;

            //Pattern to retrieve the url in the comment
            $pattern = '`((?:https?|ftp)://\S+?)(?=[[:punct:]]?(?:\s|\Z)|\Z)`';
            //Function to wrap long URLs into smaller one before replacement in the preg_replace_callback() function
            //Fonction permettant de raccourcir les longues URL lors du remplacement dans la fonction preg_replace_callback()
            $callback_function = create_function(
                '$matches',
                '$link_displayed = (strlen($matches[0]) > 50) ? substr( $matches[0], 0, 50).\'[&hellip;]\'.substr($matches[0], -10) : $matches[0];
						 return \'<a href="\'.$matches[0].\'" title="\'.$matches[0].\'" class="website" target="_blank">\'.$link_displayed.\'</a>\';'
            );
            $content = preg_replace_callback($pattern, $callback_function, $content);
        }else{
            $content = "Apparemment la vidéo n'existe plus. Merci de me le signaler ;)";
        }
        return $content;
    }

} 