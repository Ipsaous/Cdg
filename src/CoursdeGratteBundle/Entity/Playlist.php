<?php

namespace CoursdeGratteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Repository\PlaylistRepository")
 */
class Playlist
{
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir le champ")
     * @Assert\Length(min = 2)
     * @Assert\Regex("/^[a-zA-Z0-9\-\/ .'&âêôüîçïëàèùé?!]+$/", message="Le nom de la playlist n'est pas valide")
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="default_playlist", type="integer", nullable=false)
     */
    private $defaultPlaylist = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \MyUserBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="MyUserBundle\Entity\Users", inversedBy="playlists")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Playlist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set defaultPlaylist
     *
     * @param integer $defaultPlaylist
     *
     * @return Playlist
     */
    public function setDefaultPlaylist($defaultPlaylist)
    {
        $this->defaultPlaylist = $defaultPlaylist;

        return $this;
    }

    /**
     * Get defaultPlaylist
     *
     * @return integer
     */
    public function getDefaultPlaylist()
    {
        return $this->defaultPlaylist;
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
     * Set user
     *
     * @param \MyUserBundle\Entity\Users $user
     *
     * @return Playlist
     */
    public function setUser(\MyUserBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MyUserBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Playlist
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
