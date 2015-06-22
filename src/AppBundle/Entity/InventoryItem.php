<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\InventoryItemRepository")
 */
class InventoryItem {

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
     * @ORM\Column(name="serial_code", type="string", length=255, nullable=true)
     */
    private $serialCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="vendor_id", type="integer")
     */
    private $vendorId;

    /**
     * @var Vendor
     * @ORM\ManyToOne(targetEntity="Vendor")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_available", type="boolean", nullable=true)
     */
    private $isAvailable;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

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
     * @return InventoryItem
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
     * Set serialCode
     *
     * @param string $serialCode
     * @return InventoryItem
     */
    public function setSerialCode($serialCode)
    {
        $this->serialCode = $serialCode;

        return $this;
    }

    /**
     * Get serialCode
     *
     * @return string 
     */
    public function getSerialCode()
    {
        return $this->serialCode;
    }

    /**
     * Set vendorId
     *
     * @param integer $vendorId
     * @return InventoryItem
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;

        return $this;
    }

    /**
     * Get vendorId
     *
     * @return integer 
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return InventoryItem
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean 
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return InventoryItem
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
     * Set vendor
     *
     * @param \AppBundle\Entity\Vendor $vendor
     * @return InventoryItem
     */
    public function setVendor(\AppBundle\Entity\Vendor $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \AppBundle\Entity\Vendor 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

}
