<?php

namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank(message = "Aucun alias entrée")
     */
    protected $alias;

    /**
     * @ORM\OneToMany(targetEntity="Section", mappedBy="community", cascade={"all"})
     */
    protected $sections;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="community")
     */
    protected $users;

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
        $this->actualitys = new ArrayCollection();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->setPath('../../../../../img/community_couverture_default.png');
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
        return null === $this->path ? null : 'Admin/communities/'.$this->getId().'/'.$this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/Admin/communities/'.$this->getId().'/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        //return 'uploads';
        return 'image_couv';
    }



    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
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

        $s = __DIR__.'/../../../../web/Admin/communities/'.$this->getId().'/';
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
        if($this->getPath() != '../../../../../img/community_couverture_default.png'){

            if ($file = $this->getAbsolutePath()) {
                unlink($file);
            }

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

    /**
     * Set alias
     *
     * @param string $alias
     * @return Community
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
     * Set path
     *
     * @param string $path
     * @return Community
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
     * Add sections
     *
     * @param \Unetwork\AdminBundle\Entity\Section $sections
     * @return Community
     */
    public function addSection(\Unetwork\AdminBundle\Entity\Section $sections)
    {
        $this->sections[] = $sections;

        return $this;
    }

    /**
     * Remove sections
     *
     * @param \Unetwork\AdminBundle\Entity\Section $sections
     */
    public function removeSection(\Unetwork\AdminBundle\Entity\Section $sections)
    {
        $this->sections->removeElement($sections);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSections()
    {
        return $this->sections;
    }
}
