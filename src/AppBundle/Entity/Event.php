<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Event
 *
 * @ORM\Table(indexes={@ORM\Index(name="path", columns={"path"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EventRepository")
 * @UniqueEntity("path") 
 */
class Event {

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Venue")
     * @ORM\JoinTable(
     *      name="event_venues",
     *      joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="venue_id", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $venues;

    /**
     * @var string
     *
     * @ORM\Column(name="short_title", type="string", length=255)
     */
    private $shortTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, unique=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="action_btn_text", type="string", length=50, nullable=true)
     */
    private $actionBtnText;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="text")
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="header_image", type="string")
     */
    private $headerImage;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_text", type="text")
     */
    private $footerText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reservation_deadline", type="datetime")
     */
    private $reservationDeadline;

    /**
     * @var string
     *
     * @ORM\Column(name="cancellation_policy", type="text")
     */
    private $cancellationPolicy;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_terms", type="text")
     */
    private $paymentTerms;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="EventTimeline", mappedBy="event", cascade={"persist"})
     */
    private $timelineRecords;

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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortTitle
     *
     * @param string $shortTitle
     * @return Event
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;

        return $this;
    }

    /**
     * Get shortTitle
     *
     * @return string 
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return Event
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set reservationDeadline
     *
     * @param \DateTime $reservationDeadline
     * @return Event
     */
    public function setReservationDeadline($reservationDeadline)
    {
        $this->reservationDeadline = $reservationDeadline;

        return $this;
    }

    /**
     * Get reservationDeadline
     *
     * @return \DateTime 
     */
    public function getReservationDeadline()
    {
        return $this->reservationDeadline;
    }

    /**
     * Set cancellationPolicy
     *
     * @param string $cancellationPolicy
     * @return Event
     */
    public function setCancellationPolicy($cancellationPolicy)
    {
        $this->cancellationPolicy = $cancellationPolicy;

        return $this;
    }

    /**
     * Get cancellationPolicy
     *
     * @return string 
     */
    public function getCancellationPolicy()
    {
        return $this->cancellationPolicy;
    }

    /**
     * Set paymentTerms
     *
     * @param string $paymentTerms
     * @return Event
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
    }

    /**
     * Get paymentTerms
     *
     * @return string 
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * Set headerImage
     *
     * @param string $headerImage
     * @return Event
     */
    public function setHeaderImage($headerImage)
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    /**
     * Get headerImage
     *
     * @return string 
     */
    public function getHeaderImage()
    {
        return $this->headerImage;
    }

    /**
     * Set footerText
     *
     * @param string $footerText
     * @return Event
     */
    public function setFooterText($footerText)
    {
        $this->footerText = $footerText;

        return $this;
    }

    /**
     * Get footerText
     *
     * @return string 
     */
    public function getFooterText()
    {
        return $this->footerText;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->venues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add venues
     *
     * @param \AppBundle\Entity\Venue $venues
     * @return Event
     */
    public function addVenue(\AppBundle\Entity\Venue $venues)
    {
        $this->venues[] = $venues;
        return $this;
    }

    /**
     * Remove venues
     *
     * @param \AppBundle\Entity\Venue $venues
     */
    public function removeVenue(\AppBundle\Entity\Venue $venues)
    {
        $this->venues->removeElement($venues);
    }

    /**
     * Get venues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVenues()
    {
        return $this->venues;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Event
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set actionBtnText
     *
     * @param string $actionBtnText
     * @return Event
     */
    public function setActionBtnText($actionBtnText)
    {
        $this->actionBtnText = $actionBtnText;

        return $this;
    }

    /**
     * Get actionBtnText
     *
     * @return string 
     */
    public function getActionBtnText()
    {
        return $this->actionBtnText;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Add timelineRecords
     *
     * @param \AppBundle\Entity\EventTimeline $timelineRecords
     * @return Event
     */
    public function addTimelineRecord(\AppBundle\Entity\EventTimeline $timelineRecords)
    {
        $this->timelineRecords[] = $timelineRecords;

        return $this;
    }

    /**
     * Remove timelineRecords
     *
     * @param \AppBundle\Entity\EventTimeline $timelineRecords
     */
    public function removeTimelineRecord(\AppBundle\Entity\EventTimeline $timelineRecords)
    {
        $this->timelineRecords->removeElement($timelineRecords);
    }

    /**
     * Get timelineRecords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimelineRecords()
    {
        return $this->timelineRecords;
    }

    public function getUploadRootDir()
    {
        // absolute path to your directory where images must be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        return 'uploads/event';
    }

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : '/' . $this->getUploadDir() . '/' . $this->image;
    }

}
