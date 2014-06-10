<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="section")
 */
class Section
{
    
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message = "Aucune valeur entrée")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank(message = "Aucun alias entrée")
     */
    protected $alias;


    /**
     * @ORM\OneToMany(targetEntity="Actuality", mappedBy="section")
     */
    protected $actualitys;

    /**
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="sections")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */
    protected $community;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message = "Erreur insertion date created")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message = "Erreur insertion date update")
     */
    protected $updated;


    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     * @return Section
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
     * Set alias
     *
     * @param string $alias
     * @return Section
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Section
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
     * @return Section
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
     * Add actualitys
     *
     * @param \Unetwork\AdminBundle\Entity\Actuality $actualitys
     * @return Section
     */
    public function addActuality(\Unetwork\AdminBundle\Entity\Actuality $actualitys)
    {
        $this->actualitys[] = $actualitys;

        return $this;
    }

    /**
     * Remove actualitys
     *
     * @param \Unetwork\AdminBundle\Entity\Actuality $actualitys
     */
    public function removeActuality(\Unetwork\AdminBundle\Entity\Actuality $actualitys)
    {
        $this->actualitys->removeElement($actualitys);
    }

    /**
     * Get actualitys
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActualitys()
    {
        return $this->actualitys;
    }

    /**
     * Set community
     *
     * @param \Unetwork\AdminBundle\Entity\Community $community
     * @return Section
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

    /**
     * Get label
     *
     * @return \Unetwork\AdminBundle\Entity\Community 
     */
    public function getLabel()
    {
        return $this->getName().' ('.$this->getCommunity()->getName().')';
    }
}
