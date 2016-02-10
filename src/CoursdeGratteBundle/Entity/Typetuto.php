<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typetuto
 *
 * @ORM\Table(name="typetuto")
 * @ORM\Entity
 */
class Typetuto
{
    /**
     * @var string
     *
     * @ORM\Column(name="typetuto", type="string", length=100, nullable=false)
     */
    private $typetuto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set typetuto
     *
     * @param string $typetuto
     *
     * @return Typetuto
     */
    public function setTypetuto($typetuto)
    {
        $this->typetuto = $typetuto;

        return $this;
    }

    /**
     * Get typetuto
     *
     * @return string
     */
    public function getTypetuto()
    {
        return $this->typetuto;
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
