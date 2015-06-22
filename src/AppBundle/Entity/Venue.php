<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Venue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VenueRepository")
 */
class Venue {

    public function __toString()
    {
        return $this->getName() . ' (' . $this->getCapacity() . ')';
    }

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer")
     */
    private $countryId;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="VenueHall", mappedBy="venue", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $halls;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

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
     * Set name
     *
     * @param string $name
     * @return Venue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     * @return Venue
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Venue
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Venue
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return Venue
     */
    public function setCountry(\AppBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->halls = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add halls
     *
     * @param \AppBundle\Entity\VenueHall $halls
     * @return Venue
     */
    public function addHall(\AppBundle\Entity\VenueHall $halls)
    {
        $this->halls[] = $halls;

        return $this;
    }

    /**
     * Remove halls
     *
     * @param \AppBundle\Entity\VenueHall $halls
     */
    public function removeHall(\AppBundle\Entity\VenueHall $halls)
    {
        $this->halls->removeElement($halls);
    }

    /**
     * Get halls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHalls()
    {
        return $this->halls;
    }

}
