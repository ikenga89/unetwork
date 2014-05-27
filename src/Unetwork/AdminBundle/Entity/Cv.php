<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="cv")
 */
class Cv
{
    
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $jobname;

	/**
     * @ORM\Column(type="string", length=100)
     */
	protected $presentation;

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
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="cv")
     * @ORM\OrderBy({"end" = "DESC"})
     */
    protected $experience;

    /**
     * @ORM\OneToMany(targetEntity="Competence", mappedBy="cv")
     */
    protected $competence;

    /**
     * @ORM\OneToMany(targetEntity="Hobby", mappedBy="cv")
     */
    protected $hobby;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="cv")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;


    public function __construct()
    {
        $this->experience = new ArrayCollection();
        $this->competence = new ArrayCollection();
        $this->hobby = new ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return Cv
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Cv
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Cv
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Cv
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Cv
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
     * Set email
     *
     * @param string $email
     * @return Cv
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set formation
     *
     * @param string $formation
     * @return Cv
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return string 
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add experience
     *
     * @param \Unetwork\AdminBundle\Entity\Experience $experience
     * @return Cv
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
     * Set user
     *
     * @param \Unetwork\AdminBundle\Entity\User $user
     * @return Cv
     */
    public function setUser(\Unetwork\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Unetwork\AdminBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     * @return Cv
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string 
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Cv
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
     * @return Cv
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
     * Add competence
     *
     * @param \Unetwork\AdminBundle\Entity\Competence $competence
     * @return Cv
     */
    public function addCompetence(\Unetwork\AdminBundle\Entity\Competence $competence)
    {
        $this->competence[] = $competence;

        return $this;
    }

    /**
     * Remove competence
     *
     * @param \Unetwork\AdminBundle\Entity\Competence $competence
     */
    public function removeCompetence(\Unetwork\AdminBundle\Entity\Competence $competence)
    {
        $this->competence->removeElement($competence);
    }

    /**
     * Get competence
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Add hobby
     *
     * @param \Unetwork\AdminBundle\Entity\Hobby $hobby
     * @return Cv
     */
    public function addHobby(\Unetwork\AdminBundle\Entity\Hobby $hobby)
    {
        $this->hobby[] = $hobby;

        return $this;
    }

    /**
     * Remove hobby
     *
     * @param \Unetwork\AdminBundle\Entity\Hobby $hobby
     */
    public function removeHobby(\Unetwork\AdminBundle\Entity\Hobby $hobby)
    {
        $this->hobby->removeElement($hobby);
    }

    /**
     * Get hobby
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * Set jobname
     *
     * @param string $jobname
     * @return Cv
     */
    public function setJobname($jobname)
    {
        $this->jobname = $jobname;

        return $this;
    }

    /**
     * Get jobname
     *
     * @return string 
     */
    public function getJobname()
    {
        return $this->jobname;
    }
}
