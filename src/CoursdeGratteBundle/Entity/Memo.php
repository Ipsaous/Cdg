<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Memo
 *
 * @ORM\Table(name="memo", indexes={@ORM\Index(name="tuto_id", columns={"tuto_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Memo
{
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=16777215, nullable=false)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \MyUserBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="MyUserBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set content
     *
     * @param string $content
     *
     * @return Memo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Set tuto
     *
     * @param \CoursdeGratteBundle\Entity\Tutovideo $tuto
     *
     * @return Memo
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
     * @param \MyUserBundle\Entity\Users $user
     *
     * @return Memo
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
}
