<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutovideo
 *
 * @ORM\Table(name="tutovideo", indexes={@ORM\Index(name="id_artiste", columns={"id_artiste"}), @ORM\Index(name="id_difficulty", columns={"id_difficulty"}), @ORM\Index(name="id_prof", columns={"id_prof"}), @ORM\Index(name="id_style", columns={"id_style"}), @ORM\Index(name="id_typeguitare", columns={"id_typeguitare"}), @ORM\Index(name="id_typejeu", columns={"id_typejeu"}), @ORM\Index(name="id_typetuto", columns={"id_typetuto"}), @ORM\Index(name="id_styletechnique", columns={"id_styletechnique"}), @ORM\Index(name="id_styletechnique_2", columns={"id_styletechnique"}), @ORM\Index(name="titre", columns={"titre"})})
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Entity\TutoRepository")
 */
class Tutovideo
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateajout", type="datetime", nullable=false)
     */
    private $dateajout;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrvues", type="integer", nullable=false)
     */
    private $nbrvues = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrvuesparmois", type="integer", nullable=false)
     */
    private $nbrvuesparmois = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CoursdeGratteBundle\Entity\Typejeu
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Typejeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_typejeu", referencedColumnName="id")
     * })
     */
    private $idTypejeu;

    /**
     * @var \CoursdeGratteBundle\Entity\Typetuto
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Typetuto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_typetuto", referencedColumnName="id")
     * })
     */
    private $idTypetuto;

    /**
     * @var \CoursdeGratteBundle\Entity\Styletechnique
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Styletechnique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_styletechnique", referencedColumnName="id")
     * })
     */
    private $idStyletechnique;

    /**
     * @var \CoursdeGratteBundle\Entity\Typeguitare
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Typeguitare")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_typeguitare", referencedColumnName="id")
     * })
     */
    private $idTypeguitare;

    /**
     * @var \CoursdeGratteBundle\Entity\Style
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Style")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_style", referencedColumnName="id")
     * })
     */
    private $idStyle;

    /**
     * @var \CoursdeGratteBundle\Entity\Difficulty
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Difficulty")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_difficulty", referencedColumnName="id")
     * })
     */
    private $idDifficulty;

    /**
     * @var \CoursdeGratteBundle\Entity\Prof
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Prof")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prof", referencedColumnName="id")
     * })
     */
    private $idProf;

    /**
     * @var \CoursdeGratteBundle\Entity\Artiste
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Artiste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artiste", referencedColumnName="id")
     * })
     */
    private $idArtiste;

    //Field pour récup les names
    private $difficulty_name;
    private $style_name;
    private $prof_name;
    private $artiste_name;
    private $typeGuitare_name;
    private $typeJeu_name;
    private $styleTechnique_name;



    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Tutovideo
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
     * Set lientuto
     *
     * @param string $lientuto
     *
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * @return Tutovideo
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Tutovideo
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
     * Set dateajout
     *
     * @param \DateTime $dateajout
     *
     * @return Tutovideo
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;

        return $this;
    }

    /**
     * Get dateajout
     *
     * @return \DateTime
     */
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * Set nbrvues
     *
     * @param integer $nbrvues
     *
     * @return Tutovideo
     */
    public function setNbrvues($nbrvues)
    {
        $this->nbrvues = $nbrvues;

        return $this;
    }

    /**
     * Get nbrvues
     *
     * @return integer
     */
    public function getNbrvues()
    {
        return $this->nbrvues;
    }

    /**
     * Set nbrvuesparmois
     *
     * @param integer $nbrvuesparmois
     *
     * @return Tutovideo
     */
    public function setNbrvuesparmois($nbrvuesparmois)
    {
        $this->nbrvuesparmois = $nbrvuesparmois;

        return $this;
    }

    /**
     * Get nbrvuesparmois
     *
     * @return integer
     */
    public function getNbrvuesparmois()
    {
        return $this->nbrvuesparmois;
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

    /**
     * Set idTypejeu
     *
     * @param \CoursdeGratteBundle\Entity\Typejeu $idTypejeu
     *
     * @return Tutovideo
     */
    public function setIdTypejeu(\CoursdeGratteBundle\Entity\Typejeu $idTypejeu = null)
    {
        $this->idTypejeu = $idTypejeu;

        return $this;
    }

    /**
     * Get idTypejeu
     *
     * @return \CoursdeGratteBundle\Entity\Typejeu
     */
    public function getIdTypejeu()
    {
        return $this->idTypejeu;
    }

    /**
     * Set idTypetuto
     *
     * @param \CoursdeGratteBundle\Entity\Typetuto $idTypetuto
     *
     * @return Tutovideo
     */
    public function setIdTypetuto(\CoursdeGratteBundle\Entity\Typetuto $idTypetuto = null)
    {
        $this->idTypetuto = $idTypetuto;

        return $this;
    }

    /**
     * Get idTypetuto
     *
     * @return \CoursdeGratteBundle\Entity\Typetuto
     */
    public function getIdTypetuto()
    {
        return $this->idTypetuto;
    }

    /**
     * Set idStyletechnique
     *
     * @param \CoursdeGratteBundle\Entity\Styletechnique $idStyletechnique
     *
     * @return Tutovideo
     */
    public function setIdStyletechnique(\CoursdeGratteBundle\Entity\Styletechnique $idStyletechnique = null)
    {
        $this->idStyletechnique = $idStyletechnique;

        return $this;
    }

    /**
     * Get idStyletechnique
     *
     * @return \CoursdeGratteBundle\Entity\Styletechnique
     */
    public function getIdStyletechnique()
    {
        return $this->idStyletechnique;
    }

    /**
     * Set idTypeguitare
     *
     * @param \CoursdeGratteBundle\Entity\Typeguitare $idTypeguitare
     *
     * @return Tutovideo
     */
    public function setIdTypeguitare(\CoursdeGratteBundle\Entity\Typeguitare $idTypeguitare = null)
    {
        $this->idTypeguitare = $idTypeguitare;

        return $this;
    }

    /**
     * Get idTypeguitare
     *
     * @return \CoursdeGratteBundle\Entity\Typeguitare
     */
    public function getIdTypeguitare()
    {
        return $this->idTypeguitare;
    }

    /**
     * Set idStyle
     *
     * @param \CoursdeGratteBundle\Entity\Style $idStyle
     *
     * @return Tutovideo
     */
    public function setIdStyle(\CoursdeGratteBundle\Entity\Style $idStyle = null)
    {
        $this->idStyle = $idStyle;

        return $this;
    }

    /**
     * Get idStyle
     *
     * @return \CoursdeGratteBundle\Entity\Style
     */
    public function getIdStyle()
    {
        return $this->idStyle;
    }

    /**
     * Set idDifficulty
     *
     * @param \CoursdeGratteBundle\Entity\Difficulty $idDifficulty
     *
     * @return Tutovideo
     */
    public function setIdDifficulty(\CoursdeGratteBundle\Entity\Difficulty $idDifficulty = null)
    {
        $this->idDifficulty = $idDifficulty;

        return $this;
    }

    /**
     * Get idDifficulty
     *
     * @return \CoursdeGratteBundle\Entity\Difficulty
     */
    public function getIdDifficulty()
    {
        return $this->idDifficulty;
    }

    /**
     * Set idProf
     *
     * @param \CoursdeGratteBundle\Entity\Prof $idProf
     *
     * @return Tutovideo
     */
    public function setIdProf(\CoursdeGratteBundle\Entity\Prof $idProf = null)
    {
        $this->idProf = $idProf;

        return $this;
    }

    /**
     * Get idProf
     *
     * @return \CoursdeGratteBundle\Entity\Prof
     */
    public function getIdProf()
    {
        return $this->idProf;
    }

    /**
     * Set idArtiste
     *
     * @param \CoursdeGratteBundle\Entity\Artiste $idArtiste
     *
     * @return Tutovideo
     */
    public function setIdArtiste(\CoursdeGratteBundle\Entity\Artiste $idArtiste = null)
    {
        $this->idArtiste = $idArtiste;

        return $this;
    }

    /**
     * Get idArtiste
     *
     * @return \CoursdeGratteBundle\Entity\Artiste
     */
    public function getIdArtiste()
    {
        return $this->idArtiste;
    }

    /**
     * @return mixed
     */
    public function getArtisteName()
    {
        return $this->artiste_name;
    }

    /**
     * @param mixed $artiste_name
     */
    public function setArtisteName($artiste_name)
    {
        $this->artiste_name = $artiste_name;
    }

    /**
     * @return mixed
     */
    public function getDifficultyName()
    {
        return $this->difficulty_name;
    }

    /**
     * @param mixed $difficulty_name
     */
    public function setDifficultyName($difficulty_name)
    {
        $this->difficulty_name = $difficulty_name;
    }

    /**
     * @return mixed
     */
    public function getProfName()
    {
        return $this->prof_name;
    }

    /**
     * @param mixed $prof_name
     */
    public function setProfName($prof_name)
    {
        $this->prof_name = $prof_name;
    }

    /**
     * @return mixed
     */
    public function getStyleTechniqueName()
    {
        return $this->styleTechnique_name;
    }

    /**
     * @param mixed $styleTechnique_name
     */
    public function setStyleTechniqueName($styleTechnique_name)
    {
        $this->styleTechnique_name = $styleTechnique_name;
    }

    /**
     * @return mixed
     */
    public function getStyleName()
    {
        return $this->style_name;
    }

    /**
     * @param mixed $style_name
     */
    public function setStyleName($style_name)
    {
        $this->style_name = $style_name;
    }

    /**
     * @return mixed
     */
    public function getTypeGuitareName()
    {
        return $this->typeGuitare_name;
    }

    /**
     * @param mixed $typeGuitare_name
     */
    public function setTypeGuitareName($typeGuitare_name)
    {
        $this->typeGuitare_name = $typeGuitare_name;
    }

    /**
     * @return mixed
     */
    public function getTypeJeuName()
    {
        return $this->typeJeu_name;
    }

    /**
     * @param mixed $typeJeu_name
     */
    public function setTypeJeuName($typeJeu_name)
    {
        $this->typeJeu_name = $typeJeu_name;
    }


}
