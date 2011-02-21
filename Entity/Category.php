<?php

namespace Application\Jobeet2Bundle\Entity;

use Application\Jobeet2bundle\Entity\JobRepository;
use Doctrine\Common\Collections\ArrayCollections;
//use DoctrineExtensions\Sluggable\Sluggable;

/**
 * Application\Jobeet2Bundle\Entity\Category
 * @orm:Entity(repositoryClass="Application\Jobeet2Bundle\Entity\CategoryRepository")
 * @orm:Table(name="category",
 *          indexes={@orm:Index(name="slug_idx", columns={"slug"})})
 * @orm:HasLifecycleCallbacks
 */
class Category
{

    /**
     * @var integer $id
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $slug
     * @orm:Column(type="string", length=255)
     */
    private $slug;

    /**
     * @var string $name
     * @orm:Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @var integer $nJobs
     * @orm:Column(type="integer")
     */
    private $nJobs;

    /**
     * @var Application\Jobeet2Bundle\Entity\Job
     * Inverse Side
     * @orm:OneToMany(targetEntity="Job", mappedBy="category")
     */
    
    private $job;

    /**
     * @var Application\Jobeet2Bundle\Entity\Category
     *
     * Inverse Side
     * @orm:ManyToMany(targetEntity="Category", mappedBy="categories")
     */
    private $affiliates;
    
    

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * @orm:prePersist
     */
    
    public function doStuffOnPrePersist()
    {
        // Add your code here
    }
    
    /**
     * @orm:preUpdate
     */
    
    public function doStuffOnPreUpdate()
    {
        // Add your code here
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
     * Retrieves the slug field name
     * 
     * @return string
    */
    function getSlugFieldName()
    {
        return 'slug';
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
    * Retrieves the Entity fields used to generate the slug value
    *
    * @return array
    */
    function getSlugGeneratorFields()
    {
        return array('name');
    }
}