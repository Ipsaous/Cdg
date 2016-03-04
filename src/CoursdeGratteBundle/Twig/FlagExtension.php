<?php
namespace CoursdeGratteBundle\Twig;

class FlagExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('flag', array($this, 'flagFilter')),
        );
    }

    public function flagFilter($idLangue)
    {
        $flag = "images/";
        switch ($idLangue) {
            case '1':
                $flag .= 'france.jpg';
                break;
            case '2':
                $flag .= 'uk.jpg';
                break;
            case '3':
                $flag .= 'portugal.jpg';
                break;
            case '4':
                $flag .= 'deutsch.jpg';
                break;
            case '5':
                $flag .= 'spain.jpg';
                break;
            case '6':
                $flag .= 'arabe.jpg';
                break;
            case "7":
                $flag .= "italie.jpg";
                break;
        }
        return $flag;
    }

    public function getName()
    {
        return 'flag_extension';
    }
}