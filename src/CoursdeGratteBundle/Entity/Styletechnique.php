<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Styletechnique
 *
 * @ORM\Table(name="styletechnique")
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Repository\StyletechniqueRepository")
 */
class Styletechnique
{
    /**
     * @var string
     *
     * @ORM\Column(name="styletechnique", type="string", length=255, nullable=false)
     */
    private $styletechnique;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set styletechnique
     *
     * @param string $styletechnique
     *
     * @return Styletechnique
     */
    public function setStyletechnique($styletechnique)
    {
        $this->styletechnique = $styletechnique;

        return $this;
    }

    /**
     * Get styletechnique
     *
     * @return string
     */
    public function getStyletechnique()
    {
        return $this->styletechnique;
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
}
