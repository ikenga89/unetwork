<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="experience")
 */
class Experience
{
    
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $begin;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $end;

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
     * @ORM\ManyToOne(targetEntity="Cv", inversedBy="experience")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    protected $cv;

    /**
     * @ORM\ManyToOne(targetEntity="ExperienceType", inversedBy="experience")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

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
     * Set typejob
     *
     * @param string $typejob
     * @return Experience
     */
    public function setTypejob($typejob)
    {
        $this->typejob = $typejob;

        return $this;
    }

    /**
     * Get typejob
     *
     * @return string 
     */
    public function getTypejob()
    {
        return $this->typejob;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Experience
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
     * Set begin
     *
     * @param \DateTime $begin
     * @return Experience
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime 
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Experience
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set cv
     *
     * @param \Unetwork\AdminBundle\Entity\Cv $cv
     * @return Experience
     */
    public function setCv(\Unetwork\AdminBundle\Entity\Cv $cv = null)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return \Unetwork\AdminBundle\Entity\Cv 
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Experience
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
     * @return Experience
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
     * Set type
     *
     * @param \Unetwork\AdminBundle\Entity\ExperienceType $type
     * @return Experience
     */
    public function setType(\Unetwork\AdminBundle\Entity\ExperienceType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Unetwork\AdminBundle\Entity\ExperienceType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Experience
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
}
