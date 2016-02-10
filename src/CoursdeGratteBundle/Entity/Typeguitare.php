<?php

namespace CoursdeGratteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeguitare
 *
 * @ORM\Table(name="typeguitare")
 * @ORM\Entity
 */
class Typeguitare
{
    /**
     * @var string
     *
     * @ORM\Column(name="typeguitare", type="string", length=255, nullable=false)
     */
    private $typeguitare;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set typeguitare
     *
     * @param string $typeguitare
     *
     * @return Typeguitare
     */
    public function setTypeguitare($typeguitare)
    {
        $this->typeguitare = $typeguitare;

        return $this;
    }

    /**
     * Get typeguitare
     *
     * @return string
     */
    public function getTypeguitare()
    {
        return $this->typeguitare;
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
