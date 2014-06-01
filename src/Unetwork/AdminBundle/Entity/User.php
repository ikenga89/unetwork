<?php
// src/Acme/UserBundle/Entity/User.php
namespace Unetwork\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Unetwork\AdminBundle\Entity\User
 *
 * @ORM\Table(name="unetwork_users")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Unetwork\AdminBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_nais;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $linkedin;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $viadeo;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

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
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="users")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */
    protected $community;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;

    /**
     * @ORM\OneToOne(targetEntity="Cv", mappedBy="user")
     **/
    private $cv;

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->comments = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

   /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set community
     *
     * @param \Unetwork\AdminBundle\Entity\Community $community
     * @return User
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
     * Set cv
     *
     * @param \Unetwork\AdminBundle\Entity\Cv $cv
     * @return User
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
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $tab_roles = array($roles);
        $this->roles = $tab_roles;

        return $this;
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
        return null === $this->path ? null : 'App/users/'.$this->getId().'/'.$this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/App/users/'.$this->getId().'/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        //return 'uploads';
        return 'image_profil';
    }





    /*****************/
    /*  COUVERTURE


    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file_couv;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path_couv;


    public function getAbsolutePathCouv()
    {
        return null === $this->path_couv ? null : $this->getUploadRootDirCouv().'/'.$this->path_couv;
    }

    public function getWebPathCouv()
    {
        //return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
        return null === $this->path_couv ? null : 'App/users/'.$this->getId().'/'.$this->getUploadDirCouv().'/'.$this->path_couv;
    }

    protected function getUploadRootDirCouv()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/App/users/'.$this->getId().'/'.$this->getUploadDirCouv();
    }

    protected function getUploadDirCouv()
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
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadCouv()
    {
        if (null !== $this->file_couv) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path_couv = sha1(uniqid(mt_rand(), true)).'.'.$this->file_couv->guessExtension();
        }
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

        $s = __DIR__.'/../../../../web/App/users/'.$this->getId().'/';
        //$s = __DIR__.'../../../../web/App/users/'.$this->getId().'/'.$this->getUploadDir();
        //$s = $this->getUploadDir();
        if(!is_dir($s)){
        //if (!file_exists ( $s )) {
            mkdir($s, 0777, true);
            if(!is_dir($s.'/'.$this->getUploadDir())){
                mkdir ($s.'/'.$this->getUploadDir(), 0777, true);
            }
        }
        $this->file->move($s.'/'.$this->getUploadDir(), $this->path);
         
        unset($this->file);



        

        /*
        $this->file->move($this->getUploadRootDir(), $this->path);

        unset($this->file);
        */
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadCouv()
    {
        if (null === $this->file_couv) {
            return;
        }


        $s_couv = __DIR__.'/../../../../web/App/users/'.$this->getId().'/';
        //$s = __DIR__.'../../../../web/App/users/'.$this->getId().'/'.$this->getUploadDir();
        //$s = $this->getUploadDir();
        if(!is_dir($s_couv)){
        //if (!file_exists ( $s )) {
            mkdir($s_couv, 0777, true);
            if(!is_dir($s_couv.'/'.$this->getUploadDirCouv())){
                mkdir ($s_couv.'/'.$this->getUploadDirCouv(), 0777, true);
            }
        }
        $this->file_couv->move($s_couv.'/'.$this->getUploadDirCouv(), $this->path_couv);
         
        unset($this->file_couv);

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
     * @ORM\PostRemove()
     */
    public function removeUploadCouv()
    {
        if ($file_couv = $this->getAbsolutePathCouv()) {
            unlink($file_couv);
        }
    }






    /**
     * Set path
     *
     * @param string $path
     * @return User
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
     * Set ville
     *
     * @param string $ville
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set date_nais
     *
     * @param \DateTime $dateNais
     * @return User
     */
    public function setDateNais($dateNais)
    {
        $this->date_nais = $dateNais;

        return $this;
    }

    /**
     * Get date_nais
     *
     * @return \DateTime 
     */
    public function getDateNais()
    {
        return $this->date_nais;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return User
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string 
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set viadeo
     *
     * @param string $viadeo
     * @return User
     */
    public function setViadeo($viadeo)
    {
        $this->viadeo = $viadeo;

        return $this;
    }

    /**
     * Get viadeo
     *
     * @return string 
     */
    public function getViadeo()
    {
        return $this->viadeo;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return User
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
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
     * @return User
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
     * @return User
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
     * Set path_couv
     *
     * @param string $pathCouv
     * @return User
     */
    public function setPathCouv($pathCouv)
    {
        $this->path_couv = $pathCouv;

        return $this;
    }

    /**
     * Get path_couv
     *
     * @return string 
     */
    public function getPathCouv()
    {
        return $this->path_couv;
    }
}
