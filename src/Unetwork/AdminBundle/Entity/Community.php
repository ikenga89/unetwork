<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="community")
 */
class Community
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\Column(type="string", length=200)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Actuality", mappedBy="community")
     */
    protected $actualitys;


    public function __construct()
    {
        $this->actualitys = new ArrayCollection();
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
     * @return Community
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
     * Add actualitys
     *
     * @param \Unetwork\AdminBundle\Entity\Actuality $actualitys
     * @return Community
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
}
