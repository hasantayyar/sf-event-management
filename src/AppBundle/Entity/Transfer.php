<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transfer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TransferRepository")
 */
class Transfer {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="destination_point_id", type="integer")
     */
    private $destinationPointId;

    /**
     * @var TransferPoint
     * @ORM\ManyToOne(targetEntity="TransferPoint")
     * @ORM\JoinColumn(name="destination_point_id", referencedColumnName="id")
     */
    private $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="departure_point_id", type="integer")
     */
    private $departurePointId;

    /**
     * @var TransferPoint
     * @ORM\ManyToOne(targetEntity="TransferPoint")
     * @ORM\JoinColumn(name="departure_point_id", referencedColumnName="id")
     */
    private $departure;

    /**
     *
     * @var integer
     * @ORM\Column(name="venue_id", type="integer")
     */
    private $venueId;

    /**
     * @var Venue
     * @ORM\ManyToOne(targetEntity="Venue")
     * @ORM\JoinColumn(name="venue__id", referencedColumnName="id")
     */
    private $venue;

    /**
     * @var integer
     *
     * @ORM\Column(name="car_id", type="integer")
     */
    private $carId;

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
     * Set destinationPointId
     *
     * @param integer $destinationPointId
     * @return Transfer
     */
    public function setDestinationPointId($destinationPointId)
    {
        $this->destinationPointId = $destinationPointId;

        return $this;
    }

    /**
     * Get destinationPointId
     *
     * @return integer 
     */
    public function getDestinationPointId()
    {
        return $this->destinationPointId;
    }

    /**
     * Set departurePointId
     *
     * @param integer $departurePointId
     * @return Transfer
     */
    public function setDeparturePointId($departurePointId)
    {
        $this->departurePointId = $departurePointId;

        return $this;
    }

    /**
     * Get departurePointId
     *
     * @return integer 
     */
    public function getDeparturePointId()
    {
        return $this->departurePointId;
    }

    /**
     * Set carId
     *
     * @param integer $carId
     * @return Transfer
     */
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    /**
     * Get carId
     *
     * @return integer 
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\TransferPoint $destination
     * @return Transfer
     */
    public function setDestination(\AppBundle\Entity\TransferPoint $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\TransferPoint 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set departure
     *
     * @param \AppBundle\Entity\TransferPoint $departure
     * @return Transfer
     */
    public function setDeparture(\AppBundle\Entity\TransferPoint $departure = null)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return \AppBundle\Entity\TransferPoint 
     */
    public function getDeparture()
    {
        return $this->departure;
    }


    /**
     * Set venueId
     *
     * @param integer $venueId
     * @return Transfer
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
     * Set venue
     *
     * @param \AppBundle\Entity\Venue $venue
     * @return Transfer
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
