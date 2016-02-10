<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stamptutovideo
 *
 * @ORM\Table(name="stamptutovideo")
 * @ORM\Entity
 */
class Stamptutovideo
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_artiste", type="integer", nullable=true)
     */
    private $idArtiste;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_difficulty", type="integer", nullable=false)
     */
    private $idDifficulty;

    /**
     * @var string
     *
     * @ORM\Column(name="nouvelartiste", type="string", length=255, nullable=false)
     */
    private $nouvelartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="lientuto", type="string", length=255, nullable=false)
     */
    private $lientuto;

    /**
     * @var string
     *
     * @ORM\Column(name="liendemo", type="string", length=255, nullable=false)
     */
    private $liendemo;

    /**
     * @var string
     *
     * @ORM\Column(name="partie2", type="string", length=255, nullable=false)
     */
    private $partie2;

    /**
     * @var string
     *
     * @ORM\Column(name="partie3", type="string", length=255, nullable=false)
     */
    private $partie3;

    /**
     * @var string
     *
     * @ORM\Column(name="partie4", type="string", length=255, nullable=false)
     */
    private $partie4;

    /**
     * @var string
     *
     * @ORM\Column(name="partie5", type="string", length=255, nullable=false)
     */
    private $partie5;

    /**
     * @var string
     *
     * @ORM\Column(name="partie6", type="string", length=11, nullable=false)
     */
    private $partie6;

    /**
     * @var string
     *
     * @ORM\Column(name="partie7", type="string", length=11, nullable=false)
     */
    private $partie7;

    /**
     * @var string
     *
     * @ORM\Column(name="partie8", type="string", length=11, nullable=false)
     */
    private $partie8;

    /**
     * @var string
     *
     * @ORM\Column(name="partie9", type="string", length=11, nullable=false)
     */
    private $partie9;

    /**
     * @var string
     *
     * @ORM\Column(name="partie10", type="string", length=11, nullable=false)
     */
    private $partie10;

    /**
     * @var string
     *
     * @ORM\Column(name="lientablature", type="string", length=255, nullable=false)
     */
    private $lientablature;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_prof", type="integer", nullable=true)
     */
    private $idProf;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveauprof", type="string", length=255, nullable=false)
     */
    private $nouveauprof;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_style", type="integer", nullable=true)
     */
    private $idStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveaustyle", type="string", length=255, nullable=false)
     */
    private $nouveaustyle;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_langue", type="integer", nullable=true)
     */
    private $idLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="nouvellelangue", type="string", length=255, nullable=false)
     */
    private $nouvellelangue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_typeguitare", type="integer", nullable=false)
     */
    private $idTypeguitare;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_typejeu", type="integer", nullable=false)
     */
    private $idTypejeu;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_typetuto", type="integer", nullable=false)
     */
    private $idTypetuto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_styletechnique", type="integer", nullable=true)
     */
    private $idStyletechnique;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveaustyletechnique", type="string", length=255, nullable=false)
     */
    private $nouveaustyletechnique;

    /**
     * @var string
     *
     * @ORM\Column(name="siteprof", type="string", length=255, nullable=false)
     */
    private $siteprof;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Stamptutovideo
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set idArtiste
     *
     * @param integer $idArtiste
     *
     * @return Stamptutovideo
     */
    public function setIdArtiste($idArtiste)
    {
        $this->idArtiste = $idArtiste;

        return $this;
    }

    /**
     * Get idArtiste
     *
     * @return integer
     */
    public function getIdArtiste()
    {
        return $this->idArtiste;
    }

    /**
     * Set idDifficulty
     *
     * @param integer $idDifficulty
     *
     * @return Stamptutovideo
     */
    public function setIdDifficulty($idDifficulty)
    {
        $this->idDifficulty = $idDifficulty;

        return $this;
    }

    /**
     * Get idDifficulty
     *
     * @return integer
     */
    public function getIdDifficulty()
    {
        return $this->idDifficulty;
    }

    /**
     * Set nouvelartiste
     *
     * @param string $nouvelartiste
     *
     * @return Stamptutovideo
     */
    public function setNouvelartiste($nouvelartiste)
    {
        $this->nouvelartiste = $nouvelartiste;

        return $this;
    }

    /**
     * Get nouvelartiste
     *
     * @return string
     */
    public function getNouvelartiste()
    {
        return $this->nouvelartiste;
    }

    /**
     * Set lientuto
     *
     * @param string $lientuto
     *
     * @return Stamptutovideo
     */
    public function setLientuto($lientuto)
    {
        $this->lientuto = $lientuto;

        return $this;
    }

    /**
     * Get lientuto
     *
     * @return string
     */
    public function getLientuto()
    {
        return $this->lientuto;
    }

    /**
     * Set liendemo
     *
     * @param string $liendemo
     *
     * @return Stamptutovideo
     */
    public function setLiendemo($liendemo)
    {
        $this->liendemo = $liendemo;

        return $this;
    }

    /**
     * Get liendemo
     *
     * @return string
     */
    public function getLiendemo()
    {
        return $this->liendemo;
    }

    /**
     * Set partie2
     *
     * @param string $partie2
     *
     * @return Stamptutovideo
     */
    public function setPartie2($partie2)
    {
        $this->partie2 = $partie2;

        return $this;
    }

    /**
     * Get partie2
     *
     * @return string
     */
    public function getPartie2()
    {
        return $this->partie2;
    }

    /**
     * Set partie3
     *
     * @param string $partie3
     *
     * @return Stamptutovideo
     */
    public function setPartie3($partie3)
    {
        $this->partie3 = $partie3;

        return $this;
    }

    /**
     * Get partie3
     *
     * @return string
     */
    public function getPartie3()
    {
        return $this->partie3;
    }

    /**
     * Set partie4
     *
     * @param string $partie4
     *
     * @return Stamptutovideo
     */
    public function setPartie4($partie4)
    {
        $this->partie4 = $partie4;

        return $this;
    }

    /**
     * Get partie4
     *
     * @return string
     */
    public function getPartie4()
    {
        return $this->partie4;
    }

    /**
     * Set partie5
     *
     * @param string $partie5
     *
     * @return Stamptutovideo
     */
    public function setPartie5($partie5)
    {
        $this->partie5 = $partie5;

        return $this;
    }

    /**
     * Get partie5
     *
     * @return string
     */
    public function getPartie5()
    {
        return $this->partie5;
    }

    /**
     * Set partie6
     *
     * @param string $partie6
     *
     * @return Stamptutovideo
     */
    public function setPartie6($partie6)
    {
        $this->partie6 = $partie6;

        return $this;
    }

    /**
     * Get partie6
     *
     * @return string
     */
    public function getPartie6()
    {
        return $this->partie6;
    }

    /**
     * Set partie7
     *
     * @param string $partie7
     *
     * @return Stamptutovideo
     */
    public function setPartie7($partie7)
    {
        $this->partie7 = $partie7;

        return $this;
    }

    /**
     * Get partie7
     *
     * @return string
     */
    public function getPartie7()
    {
        return $this->partie7;
    }

    /**
     * Set partie8
     *
     * @param string $partie8
     *
     * @return Stamptutovideo
     */
    public function setPartie8($partie8)
    {
        $this->partie8 = $partie8;

        return $this;
    }

    /**
     * Get partie8
     *
     * @return string
     */
    public function getPartie8()
    {
        return $this->partie8;
    }

    /**
     * Set partie9
     *
     * @param string $partie9
     *
     * @return Stamptutovideo
     */
    public function setPartie9($partie9)
    {
        $this->partie9 = $partie9;

        return $this;
    }

    /**
     * Get partie9
     *
     * @return string
     */
    public function getPartie9()
    {
        return $this->partie9;
    }

    /**
     * Set partie10
     *
     * @param string $partie10
     *
     * @return Stamptutovideo
     */
    public function setPartie10($partie10)
    {
        $this->partie10 = $partie10;

        return $this;
    }

    /**
     * Get partie10
     *
     * @return string
     */
    public function getPartie10()
    {
        return $this->partie10;
    }

    /**
     * Set lientablature
     *
     * @param string $lientablature
     *
     * @return Stamptutovideo
     */
    public function setLientablature($lientablature)
    {
        $this->lientablature = $lientablature;

        return $this;
    }

    /**
     * Get lientablature
     *
     * @return string
     */
    public function getLientablature()
    {
        return $this->lientablature;
    }

    /**
     * Set idProf
     *
     * @param integer $idProf
     *
     * @return Stamptutovideo
     */
    public function setIdProf($idProf)
    {
        $this->idProf = $idProf;

        return $this;
    }

    /**
     * Get idProf
     *
     * @return integer
     */
    public function getIdProf()
    {
        return $this->idProf;
    }

    /**
     * Set nouveauprof
     *
     * @param string $nouveauprof
     *
     * @return Stamptutovideo
     */
    public function setNouveauprof($nouveauprof)
    {
        $this->nouveauprof = $nouveauprof;

        return $this;
    }

    /**
     * Get nouveauprof
     *
     * @return string
     */
    public function getNouveauprof()
    {
        return $this->nouveauprof;
    }

    /**
     * Set idStyle
     *
     * @param integer $idStyle
     *
     * @return Stamptutovideo
     */
    public function setIdStyle($idStyle)
    {
        $this->idStyle = $idStyle;

        return $this;
    }

    /**
     * Get idStyle
     *
     * @return integer
     */
    public function getIdStyle()
    {
        return $this->idStyle;
    }

    /**
     * Set nouveaustyle
     *
     * @param string $nouveaustyle
     *
     * @return Stamptutovideo
     */
    public function setNouveaustyle($nouveaustyle)
    {
        $this->nouveaustyle = $nouveaustyle;

        return $this;
    }

    /**
     * Get nouveaustyle
     *
     * @return string
     */
    public function getNouveaustyle()
    {
        return $this->nouveaustyle;
    }

    /**
     * Set idLangue
     *
     * @param integer $idLangue
     *
     * @return Stamptutovideo
     */
    public function setIdLangue($idLangue)
    {
        $this->idLangue = $idLangue;

        return $this;
    }

    /**
     * Get idLangue
     *
     * @return integer
     */
    public function getIdLangue()
    {
        return $this->idLangue;
    }

    /**
     * Set nouvellelangue
     *
     * @param string $nouvellelangue
     *
     * @return Stamptutovideo
     */
    public function setNouvellelangue($nouvellelangue)
    {
        $this->nouvellelangue = $nouvellelangue;

        return $this;
    }

    /**
     * Get nouvellelangue
     *
     * @return string
     */
    public function getNouvellelangue()
    {
        return $this->nouvellelangue;
    }

    /**
     * Set idTypeguitare
     *
     * @param integer $idTypeguitare
     *
     * @return Stamptutovideo
     */
    public function setIdTypeguitare($idTypeguitare)
    {
        $this->idTypeguitare = $idTypeguitare;

        return $this;
    }

    /**
     * Get idTypeguitare
     *
     * @return integer
     */
    public function getIdTypeguitare()
    {
        return $this->idTypeguitare;
    }

    /**
     * Set idTypejeu
     *
     * @param integer $idTypejeu
     *
     * @return Stamptutovideo
     */
    public function setIdTypejeu($idTypejeu)
    {
        $this->idTypejeu = $idTypejeu;

        return $this;
    }

    /**
     * Get idTypejeu
     *
     * @return integer
     */
    public function getIdTypejeu()
    {
        return $this->idTypejeu;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Stamptutovideo
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set idTypetuto
     *
     * @param integer $idTypetuto
     *
     * @return Stamptutovideo
     */
    public function setIdTypetuto($idTypetuto)
    {
        $this->idTypetuto = $idTypetuto;

        return $this;
    }

    /**
     * Get idTypetuto
     *
     * @return integer
     */
    public function getIdTypetuto()
    {
        return $this->idTypetuto;
    }

    /**
     * Set idStyletechnique
     *
     * @param integer $idStyletechnique
     *
     * @return Stamptutovideo
     */
    public function setIdStyletechnique($idStyletechnique)
    {
        $this->idStyletechnique = $idStyletechnique;

        return $this;
    }

    /**
     * Get idStyletechnique
     *
     * @return integer
     */
    public function getIdStyletechnique()
    {
        return $this->idStyletechnique;
    }

    /**
     * Set nouveaustyletechnique
     *
     * @param string $nouveaustyletechnique
     *
     * @return Stamptutovideo
     */
    public function setNouveaustyletechnique($nouveaustyletechnique)
    {
        $this->nouveaustyletechnique = $nouveaustyletechnique;

        return $this;
    }

    /**
     * Get nouveaustyletechnique
     *
     * @return string
     */
    public function getNouveaustyletechnique()
    {
        return $this->nouveaustyletechnique;
    }

    /**
     * Set siteprof
     *
     * @param string $siteprof
     *
     * @return Stamptutovideo
     */
    public function setSiteprof($siteprof)
    {
        $this->siteprof = $siteprof;

        return $this;
    }

    /**
     * Get siteprof
     *
     * @return string
     */
    public function getSiteprof()
    {
        return $this->siteprof;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Stamptutovideo
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
