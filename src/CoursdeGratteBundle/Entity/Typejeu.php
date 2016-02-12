<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typejeu
 *
 * @ORM\Table(name="typejeu")
 * @ORM\Entity(repositoryClass="CoursdeGratteBundle\Repository\TypejeuRepository")
 */
class Typejeu
{
    /**
     * @var string
     *
     * @ORM\Column(name="typejeu", type="string", length=255, nullable=false)
     */
    private $typejeu;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set typejeu
     *
     * @param string $typejeu
     *
     * @return Typejeu
     */
    public function setTypejeu($typejeu)
    {
        $this->typejeu = $typejeu;

        return $this;
    }

    /**
     * Get typejeu
     *
     * @return string
     */
    public function getTypejeu()
    {
        return $this->typejeu;
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
