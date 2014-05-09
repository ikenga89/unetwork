<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="experience_type")
 */
class ExperienceType
{
    
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $libelle;

    /**
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="type")
     */
    protected $experience;

    public function __construct()
    {
        $this->experience = new ArrayCollection();
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
     * @return ExperienceType
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
     * Add experience
     *
     * @param \Unetwork\AdminBundle\Entity\Experience $experience
     * @return ExperienceType
     */
    public function addExperience(\Unetwork\AdminBundle\Entity\Experience $experience)
    {
        $this->experience[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \Unetwork\AdminBundle\Entity\Experience $experience
     */
    public function removeExperience(\Unetwork\AdminBundle\Entity\Experience $experience)
    {
        $this->experience->removeElement($experience);
    }

    /**
     * Get experience
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return ExperienceType
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}
