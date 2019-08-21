<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="iduser", type="string", length=50, nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=70, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="infopartenaire", type="string", length=50, nullable=false)
     */
    private $infopartenaire;

    /**
     * @var string
     *
     * @ORM\Column(name="credzuulu", type="string", length=80, nullable=false)
     */
    private $credzuulu;

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
     * @param string $iduser
     *
     * @return Users
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return string
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Users
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
     * Set infopartenaire
     *
     * @param string $infopartenaire
     *
     * @return Users
     */
    public function setInfopartenaire($infopartenaire)
    {
        $this->infopartenaire = $infopartenaire;

        return $this;
    }

    /**
     * Get infopartenaire
     *
     * @return string
     */
    public function getInfopartenaire()
    {
        return $this->infopartenaire;
    }

    /**
     * Set credzuulu
     *
     * @param string $credzuulu
     *
     * @return Users
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
