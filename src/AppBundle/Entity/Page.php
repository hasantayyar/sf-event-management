<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PageRepository")
 */
class Page {

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
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255)
     */
    private $tags;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isToplink", type="boolean")
     */
    private $isToplink;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFooterlink", type="boolean")
     */
    private $isFooterlink;

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
     * @return Page
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
     * Set content
     *
     * @param string $content
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Page
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set isToplink
     *
     * @param boolean $isToplink
     * @return Page
     */
    public function setIsToplink($isToplink)
    {
        $this->isToplink = $isToplink;

        return $this;
    }

    /**
     * Get isToplink
     *
     * @return boolean 
     */
    public function getIsToplink()
    {
        return $this->isToplink;
    }

    /**
     * Set isFooterlink
     *
     * @param boolean $isFooterlink
     * @return Page
     */
    public function setIsFooterlink($isFooterlink)
    {
        $this->isFooterlink = $isFooterlink;

        return $this;
    }

    /**
     * Get isFooterlink
     *
     * @return boolean 
     */
    public function getIsFooterlink()
    {
        return $this->isFooterlink;
    }

}
