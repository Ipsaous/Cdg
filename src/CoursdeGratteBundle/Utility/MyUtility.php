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

} 