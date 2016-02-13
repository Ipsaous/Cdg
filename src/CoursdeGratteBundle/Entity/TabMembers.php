<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TabMembers
 *
 * @ORM\Table(name="tab_members", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="tuto_id", columns={"tuto_id"})})
 * @ORM\Entity
 */
class TabMembers
{
    /**
     * @var string
     *
     * @ORM\Column(name="tab_link", type="string", length=255, nullable=false)
     */
    private $tabLink;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_valid", type="boolean", nullable=false)
     */
    private $isValid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=false)
     */
    private $fileName;

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
     * @var \CoursdeGratteBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="MyUserBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set tabLink
     *
     * @param string $tabLink
     *
     * @return TabMembers
     */
    public function setTabLink($tabLink)
    {
        $this->tabLink = $tabLink;

        return $this;
    }

    /**
     * Get tabLink
     *
     * @return string
     */
    public function getTabLink()
    {
        return $this->tabLink;
    }

    /**
     * Set isValid
     *
     * @param boolean $isValid
     *
     * @return TabMembers
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return TabMembers
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
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
     * @return TabMembers
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
     * @return TabMembers
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
