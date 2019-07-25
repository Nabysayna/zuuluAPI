<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operations
 *
 * @ORM\Table(name="operations")
 * @ORM\Entity
 */
class Operations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="infoop", type="integer", nullable=false)
     */
    private $infoop;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateoperation", type="integer", nullable=false)
     */
    private $dateoperation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Operations
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set infoop
     *
     * @param integer $infoop
     *
     * @return Operations
     */
    public function setInfoop($infoop)
    {
        $this->infoop = $infoop;

        return $this;
    }

    /**
     * Get infoop
     *
     * @return integer
     */
    public function getInfoop()
    {
        return $this->infoop;
    }

    /**
     * Set dateoperation
     *
     * @param integer $dateoperation
     *
     * @return Operations
     */
    public function setDateoperation($dateoperation)
    {
        $this->dateoperation = $dateoperation;

        return $this;
    }

    /**
     * Get dateoperation
     *
     * @return integer
     */
    public function getDateoperation()
    {
        return $this->dateoperation;
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
