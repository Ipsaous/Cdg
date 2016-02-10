<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prof
 *
 * @ORM\Table(name="prof", indexes={@ORM\Index(name="id_langue", columns={"id_langue"})})
 * @ORM\Entity
 */
class Prof
{
    /**
     * @var string
     *
     * @ORM\Column(name="prof", type="string", length=255, nullable=false)
     */
    private $prof;

    /**
     * @var string
     *
     * @ORM\Column(name="siteprof", type="string", length=255, nullable=false)
     */
    private $siteprof;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CoursdeGratteBundle\Entity\Langue
     *
     * @ORM\ManyToOne(targetEntity="CoursdeGratteBundle\Entity\Langue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_langue", referencedColumnName="id")
     * })
     */
    private $idLangue;



    /**
     * Set prof
     *
     * @param string $prof
     *
     * @return Prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;

        return $this;
    }

    /**
     * Get prof
     *
     * @return string
     */
    public function getProf()
    {
        return $this->prof;
    }

    /**
     * Set siteprof
     *
     * @param string $siteprof
     *
     * @return Prof
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idLangue
     *
     * @param \CoursdeGratteBundle\Entity\Langue $idLangue
     *
     * @return Prof
     */
    public function setIdLangue(\CoursdeGratteBundle\Entity\Langue $idLangue = null)
    {
        $this->idLangue = $idLangue;

        return $this;
    }

    /**
     * Get idLangue
     *
     * @return \CoursdeGratteBundle\Entity\Langue
     */
    public function getIdLangue()
    {
        return $this->idLangue;
    }
}
