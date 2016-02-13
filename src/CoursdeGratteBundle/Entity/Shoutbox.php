<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shoutbox
 *
 * @ORM\Table(name="shoutbox", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Shoutbox
{
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posted_at", type="datetime", nullable=false)
     */
    private $postedAt;

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
     * @ORM\ManyToOne(targetEntity="MyUserBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set message
     *
     * @param string $message
     *
     * @return Shoutbox
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set postedAt
     *
     * @param \DateTime $postedAt
     *
     * @return Shoutbox
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
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
     * @return Shoutbox
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
