<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{


    /**
     * @ORM\ManyToOne(targetEntity="Actuality", inversedBy="comments")
     * @ORM\JoinColumn(name="actuality_id", referencedColumnName="id")
     */
    protected $actuality;

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

	/**
     * @ORM\Column(type="string", length=500)
     */
    protected $content;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
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
     * Set actuality
     *
     * @param \Unetwork\AdminBundle\Entity\Actuality $actuality
     * @return Comment
     */
    public function setActuality(\Unetwork\AdminBundle\Entity\Actuality $actuality = null)
    {
        $this->actuality = $actuality;

        return $this;
    }

    /**
     * Get actuality
     *
     * @return \Unetwork\AdminBundle\Entity\Actuality 
     */
    public function getActuality()
    {
        return $this->actuality;
    }

}
