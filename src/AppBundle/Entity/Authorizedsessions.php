<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Authorizedsessions
 *
 * @ORM\Table(name="authorizedSessions")
 * @ORM\Entity
 */
class Authorizedsessions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="credzuulu", type="string", length=80, nullable=false)
     */
    private $credzuulu;

    /**
     * @var string
     *
     * @ORM\Column(name="randomdigest", type="string", length=80, nullable=false)
     */
    private $randomdigest;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="validite", type="integer", nullable=false)
     */
    private $validite;

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
     * @return Authorizedsessions
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
     * Set credzuulu
     *
     * @param string $credzuulu
     *
     * @return Authorizedsessions
     */
    public function setCredzuulu($credzuulu)
    {
        $this->credzuulu = $credzuulu;

        return $this;
    }

    /**
     * Get credzuulu
     *
     * @return string
     */
    public function getCredzuulu()
    {
        return $this->credzuulu;
    }

    /**
     * Set randomdigest
     *
     * @param string $randomdigest
     *
     * @return Authorizedsessions
     */
    public function setRandomdigest($randomdigest)
    {
        $this->randomdigest = $randomdigest;

        return $this;
    }

    /**
     * Get randomdigest
     *
     * @return string
     */
    public function getRandomdigest()
    {
        return $this->randomdigest;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Authorizedsessions
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set validite
     *
     * @param integer $validite
     *
     * @return Authorizedsessions
     */
    public function setValidite($validite)
    {
        $this->validite = $validite;

        return $this;
    }

    /**
     * Get validite
     *
     * @return integer
     */
    public function getValidite()
    {
        return $this->validite;
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
