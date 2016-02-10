<?php

namespace CoursdeGratteBundle\Entity;

/**
 * Paramuser
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Entity\ParamuserRepository")
 */
class Paramuser
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
     * @var \CoursdeGratteBundle\Entity\Users
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $userId;

    /**
     * @var \CoursdeGratteBundle\Entity\Langue
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Langue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="langue_id", referencedColumnName="id")
     * })
     */
    private $langueId;


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
     * @param \CoursdeGratteBundle\Entity\Users $userId
     *
     * @return Paramuser
     */
    public function setUserId(\CoursdeGratteBundle\Entity\Users $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoursdeGratteBundle\Entity\Users
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set langue
     *
     * @param \CoursdeGratteBundle\Entity\Langue $langueId
     *
     * @return Paramuser
     */
    public function setLangue(\CoursdeGratteBundle\Entity\Langue $langueId = null)
    {
        $this->langueId = $langueId;

        return $this;
    }

    /**
     * Get langue
     *
     * @return \CoursdeGratteBundle\Entity\Langue
     */
    public function getLangueId()
    {
        return $this->langueId;
    }
}

