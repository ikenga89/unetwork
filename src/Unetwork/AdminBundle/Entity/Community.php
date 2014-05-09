<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message = "Aucune valeur entrée")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Actuality", mappedBy="community", cascade={"all"})
     */
    protected $actualitys;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="community")
     */
    protected $users;

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

    /**
     * Add users
     *
     * @param \Unetwork\AdminBundle\Entity\User $users
     * @return Community
     */
    public function addUser(\Unetwork\AdminBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Unetwork\AdminBundle\Entity\User $users
     */
    public function removeUser(\Unetwork\AdminBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Community
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
     * @return Community
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
}
