<?php

namespace MyUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="MyUserBundle\Repository\UsersRepository")
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

    protected $default_langue;



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
     * @return mixed
     */
    public function getDefaultLangue()
    {
        return $this->default_langue;
    }

    /**
     * @param mixed $default_langue
     */
    public function setDefaultLangue($default_langue)
    {
        $this->default_langue = $default_langue;
    }



}