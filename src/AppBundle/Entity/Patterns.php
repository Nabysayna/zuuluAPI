<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patterns
 *
 * @ORM\Table(name="patterns")
 * @ORM\Entity
 */
class Patterns
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sizemin", type="integer", nullable=false)
     */
    private $sizemin;

    /**
     * @var integer
     *
     * @ORM\Column(name="sizemax", type="integer", nullable=false)
     */
    private $sizemax;

    /**
     * @var string
     *
     * @ORM\Column(name="servicename", type="string", length=50, nullable=false)
     */
    private $servicename;

    /**
     * @var string
     *
     * @ORM\Column(name="servicedesignation", type="string", length=10, nullable=false)
     */
    private $servicedesignation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set sizemin
     *
     * @param integer $sizemin
     *
     * @return Patterns
     */
    public function setSizemin($sizemin)
    {
        $this->sizemin = $sizemin;

        return $this;
    }

    /**
     * Get sizemin
     *
     * @return integer
     */
    public function getSizemin()
    {
        return $this->sizemin;
    }

    /**
     * Set sizemax
     *
     * @param integer $sizemax
     *
     * @return Patterns
     */
    public function setSizemax($sizemax)
    {
        $this->sizemax = $sizemax;

        return $this;
    }

    /**
     * Get sizemax
     *
     * @return integer
     */
    public function getSizemax()
    {
        return $this->sizemax;
    }

    /**
     * Set servicename
     *
     * @param string $servicename
     *
     * @return Patterns
     */
    public function setServicename($servicename)
    {
        $this->servicename = $servicename;

        return $this;
    }

    /**
     * Get servicename
     *
     * @return string
     */
    public function getServicename()
    {
        return $this->servicename;
    }

    /**
     * Set servicedesignation
     *
     * @param string $servicedesignation
     *
     * @return Patterns
     */
    public function setServicedesignation($servicedesignation)
    {
        $this->servicedesignation = $servicedesignation;

        return $this;
    }

    /**
     * Get servicedesignation
     *
     * @return string
     */
    public function getServicedesignation()
    {
        return $this->servicedesignation;
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
