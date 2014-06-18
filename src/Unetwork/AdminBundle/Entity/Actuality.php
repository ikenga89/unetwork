<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="text")
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
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="actualitys")
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id")
     */
    protected $section;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }





    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        //return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
        return null === $this->path ? null : 'Admin/actualities/'.$this->getId().'/'.$this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/Admin/actualities/'.$this->getId().'/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        //return 'uploads';
        return 'image';
    }






    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
        $this->setUpdated(new \DateTime());
    }



    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a

        $s = __DIR__.'/../../../../web/Admin/actualities/'.$this->getId().'/';
        if(!is_dir($s)){
            mkdir($s, 0777, true);
            if(!is_dir($s.'/'.$this->getUploadDir())){
                mkdir ($s.'/'.$this->getUploadDir(), 0777, true);
            }
        }
        $this->file->move($s.'/'.$this->getUploadDir(), $this->path);
         
        unset($this->file);
    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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
     * Set path
     *
     * @param string $path
     * @return Actuality
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set section
     *
     * @param \Unetwork\AdminBundle\Entity\Section $section
     * @return Actuality
     */
    public function setSection(\Unetwork\AdminBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Unetwork\AdminBundle\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }

}
