<?php



namespace Application\Jobeet2Bundle\Entity;

use Application\Jobeet2Bundle\Util\SlugNormalizer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Application\Jobeet2Bundle\Entity\Job
 * @ORM\Entity(repositoryClass="Application\Jobeet2Bundle\Entity\JobRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="job")
 *
 */
class Job
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
   
   
    /**
     * @var string $type
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string $company
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @var string $logo
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string $url
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string $position
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     */
    private $position;

    /**
     * @var string $location
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     */
    private $location;

    /**
     * @var string $description
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @var string $how_to_apply
     * @ORM\Column(type="string", length=4000, nullable=true)
     */
    private $how_to_apply;

    /**
     * @var string $token
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var boolean $is_public
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_public;

    /**
     * @var boolean $is_activated
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_activated;

    /**
     * @var string $email
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var datetime $expires_at
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expires_at;

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


    /**
     * @var Application\Jobeet2Bundle\Entity\Category
     *
     * owning Side
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="job")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\Type(type="Application\Jobeet2Bundle\Entity\Category")
      */

    private $category;
    
    /**
     * @var integer $active_days
     */
    
    private $active_days;
    
    /**
     * Constructor
     * @param integer $active_days
     */
    
    function __construct($active_days = 30)
    {
    	$this->active_days = $active_days;
        $this->type = 'full-time';
        $this->is_public = true;
        $this->is_activated = false;
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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set logo
     *
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return string $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set how_to_apply
     *
     * @param string $howToApply
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;
    }

    /**
     * Get how_to_apply
     *
     * @return string $howToApply
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * Set token
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @return string $token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    }

    /**
     * Get is_public
     *
     * @return boolean $isPublic
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;
    }

    /**
     * Get is_activated
     *
     * @return boolean $isActivated
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set expires_at
     *
     * @param datetime $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;
    }

    /**
     * Get expires_at
     *
     * @return datetime $expiresAt
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param Application\Jobeet2Bundle\Entity\Category $category
     */
    public function setCategory(\Application\Jobeet2Bundle\Entity\Category $category)
    {
        $this->category = $category;
        $this->category->addJob($this);    
    }

    /**ORM\
     * Get category
     *
     * @return Application\Jobeet2Bundle\Entity\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Retrieves the company slug 
     * 
     * @return string
    */
    public function getCompanySlug()
    {
        return new SlugNormalizer($this->company);
    }
    
	/**
     * Retrieves the company slug 
     * 
     * @return string
    */
    public function getLocationSlug()
    {
        return new SlugNormalizer($this->location);
    }
    
	/**
     * Retrieves the company slug 
     * 
     * @return string
    */
    public function getPositionSlug()
    {
        return new SlugNormalizer($this->position);
    }
    
    /**
     * get active_days
     * 
     * @return integer;
     */
    
    function getActiveDays()
    {
    	return $this->active_days;
    }
    
    function setActiveDays($active_days)
    {
    	$this->active_days = $active_days;
    }

    public function isExpired()
    {
        return $this->getDaysBeforeExpires() < 0;
    }

    public function expiresSoon()
    {
        return $this->getDaysBeforeExpires() < 5;
    }

    public function getDaysBeforeExpires()
    {
        $interval = $this->expires_at->diff(new \DateTime('now'));
        return $interval->format('%a');
    }

        
    /**
     * @ORM\PrePersist
     */

    public function touchCreated()
    {
        if (isset ($this->active_days))
        {
            $this->created_at = $this->updated_at = new \DateTime();
            $str = sprintf('P%sD',$this->active_days);
            $date = new \DateTime('now');
            $this->setExpiresAt($date->add(new \DateInterval($str)));
        }

        //set token if not
        if (!isset($this->token))
        {
            $this->setToken(sha1($this->getEmail().rand(11111,99999)));
        }
    }

    /**
     * @ORM\PreUpdate
     */

    public function touchUpdated()
    {
        $this->updated_at = new \DateTime('now');             
    }

    static public function getJobTypes()
    {
        return array(
            'full-time' => 'Full time',
            'part-time' => 'Part time',
            'freelance' => 'Freelance',
        );
    }
}