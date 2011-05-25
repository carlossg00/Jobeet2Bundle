<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Application\Jobeet2bundle\Entity\JobRepository;
use Doctrine\Common\Collections\ArrayCollections;
use Application\Jobeet2Bundle\Util\SlugNormalizer;




/**
 * Application\Jobeet2Bundle\Entity\Category
 * @ORM\Entity(repositoryClass="Application\Jobeet2Bundle\Entity\CategoryRepository")
 * @ORM\Table(name="category",
 *          indexes={@ORM\Index(name="slug_idx", columns={"slug"})})
 * @ORM\HasLifecycleCallbacks
 */
class Category
{

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $slug
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @var integer $nJobs
     * @ORM\Column(type="integer")
     */
    private $nJobs;

    /**
     * @var Application\Jobeet2Bundle\Entity\Job
     * Inverse Side
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    
    private $job;

    /**
     * @var Application\Jobeet2Bundle\Entity\Category
     *
     * Inverse Side
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="categories")
     */
    private $affiliates;
    
    /**
     * @var datetime $created_at
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;    
    

    public function __construct()
    {        
        $this->job = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nJobs = 0;  
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add job
     *
     * @param Application\Jobeet2Bundle\Entity\Job $job
     */
    public function addJob(\Application\Jobeet2Bundle\Entity\Job $job)
    {
        $this->job[] = $job;
        $this->nJobs++;
    }

    /**
     * Get job
     *
     * @return Doctrine\Common\Collections\Collection $job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Add affiliates
     *
     * @param Application\Jobeet2Bundle\Entity\Category $affiliates
     */
    public function addAffiliates(\Application\Jobeet2Bundle\Entity\Category $affiliates)
    {
        $this->affiliates[] = $affiliates;
    }

    /**
     * Get affiliates
     *
     * @return Doctrine\Common\Collections\Collection $affiliates
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }  
    
    /**
     * @ORM\prePersist
     */
    
    public function touchCreated()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
        $this->slug = new SlugNormalizer($this->name);
    }
    
    /**
     * @ORM\preUpdate
     */
    
    public function touchUpdated()
    {
        $this->updatedAt = new \DateTime();
    }   
    

    /**
     * Set nJobs
     *
     * @param integer $nJobs
     */
    public function setNJobs($nJobs)
    {
        $this->numJobs = \intval($nJobs);
    }

    /**
     * Get nJobs
     *
     * @return integer $nJobs
     */
    public function getNJobs()
    {
        return $this->nJobs;
    }
    
   
    /**
     * Retrieves the slug
     *
     * @return string
    */
    function getSlug()
    {
        return $this->slug;
    }
    
	/**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

   
}