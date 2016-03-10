<?php

namespace MyUserBundle\Entity;

use CoursdeGratteBundle\Entity\Favoris;
use CoursdeGratteBundle\Entity\Paramuser;
use CoursdeGratteBundle\Entity\Playlist;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Entity
 *
 */
class Users extends BaseUser
{

    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter_active", type="boolean", nullable=false)
     */
    protected $newsletterActive = '1';


    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_propositions", type="integer", nullable=false)
     */
    protected $nbrePropositions = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \CoursdeGratteBundle\Entity\Paramuser
     * @ORM\OneToMany(targetEntity="CoursdeGratteBundle\Entity\Paramuser", mappedBy="userId")
     *
     */
    protected $defaultLangue;

    /**
     * @ORM\OneToMany(targetEntity="CoursdeGratteBundle\Entity\Playlist", mappedBy="user")
     */
    protected $playlists;
    /**
     * @ORM\OneToMany(targetEntity="CoursdeGratteBundle\Entity\Favoris", mappedBy="user")
     */
    protected $favoris;


    public function __construct(){
        parent::__construct();
        $this->playlists = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }

    /**
     * @param Favoris $favoris
     * @internal param Playlist $playlist
     * @return $this
     */
    public function addFavoris(Favoris $favoris){

        $this->favoris[] = $favoris;
        $favoris->setUser($this);
        return $this;

    }

    /**
     * @param Favoris $favoris
     */
    public function removeFavoris(Favoris $favoris){
        $this->favoris->removeElement($favoris);
    }

    /**
     * @return ArrayCollection
     */
    public function getFavoris(){
        return $this->favoris;
    }

    /**
     * @param Playlist $playlist
     * @return $this
     */
    public function addPlaylist(Playlist $playlist ){

        $this->playlists[] = $playlist;
        $playlist->setUser($this);
        return $this;

    }

    public function removePlaylist(Playlist $playlist){
        $this->playlists->removeElement($playlist);
    }

    public function getPlaylists(){
        return $this->playlists;
    }

    /**
     * Set newsletterActive
     *
     * @param boolean $newsletterActive
     *
     * @return Users
     */
    public function setNewsletterActive($newsletterActive)
    {
        $this->newsletterActive = $newsletterActive;

        return $this;
    }

    /**
     * Get newsletterActive
     *
     * @return boolean
     */
    public function getNewsletterActive()
    {
        return $this->newsletterActive;
    }

    /**
     * Set nbrePropositions
     *
     * @param integer $nbrePropositions
     *
     * @return Users
     */
    public function setNbrePropositions($nbrePropositions)
    {
        $this->nbrePropositions = $nbrePropositions;

        return $this;
    }

    /**
     * Get nbrePropositions
     *
     * @return integer
     */
    public function getNbrePropositions()
    {
        return $this->nbrePropositions;
    }

    public function setId($id){
        return $this->id = $id;
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
     * @return \CoursdeGratteBundle\Entity\Paramuser
     */
    public function getDefaultLangue()
    {
        return $this->defaultLangue;
    }

    /**
     * @param "CoursdeGratte\Entity\Paramuser" $defaultLangue
     * @return Users
     */
    public function setDefaultLangue(Paramuser $defaultLangue)
    {
        $this->defaultLangue = $defaultLangue;
        $defaultLangue->setUserId($this);

        return $this;

    }

    public function addSalt($salt){
        $this->salt = $salt;
    }

}
