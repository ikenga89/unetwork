<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="actuality")
 */
class Actuality
{

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="actualitys", cascade={"all"})
     * @ORM\OrderBy({"created" = "DESC"})
     */
    protected $comments;

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message = "Aucune valeur saisie")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    protected $updated;


    /**
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="actualitys")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */
    protected $community;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
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

    /**
     * Set description
     *
     * @param string $description
     * @return Actuality
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
     * Set created
     *
     * @param \DateTime $created
     * @return Actuality
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Actuality
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add comments
     *
     * @param \Unetwork\AdminBundle\Entity\Comment $comments
     * @return Actuality
     */
    public function addComment(\Unetwork\AdminBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Unetwork\AdminBundle\Entity\Comment $comments
     */
    public function removeComment(\Unetwork\AdminBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set community
     *
     * @param \Unetwork\AdminBundle\Entity\Community $community
     * @return Actuality
     */
    public function setCommunity(\Unetwork\AdminBundle\Entity\Community $community = null)
    {
        $this->community = $community;

        return $this;
    }

    /**
     * Get community
     *
     * @return \Unetwork\AdminBundle\Entity\Community 
     */
    public function getCommunity()
    {
        return $this->community;
    }
}
