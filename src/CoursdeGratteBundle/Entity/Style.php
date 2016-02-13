<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Style
 *
 * @ORM\Table(name="style")
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Repository\StyleRepository")
 */
class Style
{
    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255, nullable=false)
     */
    private $style;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set style
     *
     * @param string $style
     *
     * @return Style
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
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
