<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VenueHall
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class VenueHall {

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
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=255)
     */
    private $shortName;

    /**
     * @var integer
     *
     * @ORM\Column(name="venue_id", type="integer")
     */
    private $venueId;

    /**
     *
     * @var Venue 
     * @ORM\ManyToOne(targetEntity="Venue",inversedBy="halls")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id", nullable=TRUE)
     */
    private $venue;

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
     * @return VenueHall
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
     * Set shortName
     *
     * @param string $shortName
     * @return VenueHall
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set venueId
     *
     * @param integer $venueId
     * @return VenueHall
     */
    public function setVenueId($venueId)
    {
        $this->venueId = $venueId;

        return $this;
    }

    /**
     * Get venueId
     *
     * @return integer 
     */
    public function getVenueId()
    {
        return $this->venueId;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return VenueHall
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
     * Set venue
     *
     * @param \AppBundle\Entity\Venue $venue
     * @return VenueHall
     */
    public function setVenue(\AppBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \AppBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }

}
