<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PhoneRepository")
 */
class Phone {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="full_number", type="string", length=255)
     */
    private $fullNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=10)
     */
    private $countryCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_mobile", type="boolean")
     */
    private $isMobile;

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
     * Set type
     *
     * @param string $type
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fullNumber
     *
     * @param string $fullNumber
     * @return Phone
     */
    public function setFullNumber($fullNumber)
    {
        $this->fullNumber = $fullNumber;

        return $this;
    }

    /**
     * Get fullNumber
     *
     * @return string 
     */
    public function getFullNumber()
    {
        return $this->fullNumber;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     * @return Phone
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string 
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set isMobile
     *
     * @param boolean $isMobile
     * @return Phone
     */
    public function setIsMobile($isMobile)
    {
        $this->isMobile = $isMobile;

        return $this;
    }

    /**
     * Get isMobile
     *
     * @return boolean 
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

}
