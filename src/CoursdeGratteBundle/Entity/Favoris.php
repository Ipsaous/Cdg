<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="tuto_id", columns={"tuto_id"}), @ORM\Index(name="playlist_id", columns={"playlist_id"})})
 * @ORM\Entity
 */
class Favoris
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CoursdeGratteBundle\Entity\Playlist
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Playlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     * })
     */
    private $playlist;

    /**
     * @var \CoursdeGratteBundle\Entity\Tutovideo
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Tutovideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tuto_id", referencedColumnName="id")
     * })
     */
    private $tuto;

    /**
     * @var \CoursdeGratteBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set playlist
     *
     * @param \CoursdeGratteBundle\Entity\Playlist $playlist
     *
     * @return Favoris
     */
    public function setPlaylist(\CoursdeGratteBundle\Entity\Playlist $playlist = null)
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * Get playlist
     *
     * @return \CoursdeGratteBundle\Entity\Playlist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * Set tuto
     *
     * @param \CoursdeGratteBundle\Entity\Tutovideo $tuto
     *
     * @return Favoris
     */
    public function setTuto(\CoursdeGratteBundle\Entity\Tutovideo $tuto = null)
    {
        $this->tuto = $tuto;

        return $this;
    }

    /**
     * Get tuto
     *
     * @return \CoursdeGratteBundle\Entity\Tutovideo
     */
    public function getTuto()
    {
        return $this->tuto;
    }

    /**
     * Set user
     *
     * @param \CoursdeGratteBundle\Entity\Users $user
     *
     * @return Favoris
     */
    public function setUser(\CoursdeGratteBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoursdeGratteBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
}
