<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Application\Jobeet2Bundle\Entity\Affiliate
 * @ORM\Entity(repositoryClass="Application\Jobeet2Bundle\Entity\AffiliateRepository")
 * @ORM\Table(name="affiliate")
 * @ORM\HasLifecycleCallbacks
 *
 */
class Affiliate
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $url
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @var string $email
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string $token
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @var boolean $is_active
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @var Application\Jobeet2Bundle\Entity\Category
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="affiliates")
     * @ORM\JoinTable(name="category_affiliate",
     *      joinColumns={@ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *      )
     */ 

    
    private $categories;

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
     * Set is_active
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * Get is_active
     *
     * @return boolean $isActive
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Add categories
     *
     * @param Application\Jobeet2Bundle\Entity\Category $categories
     */
    public function addCategories(\Application\Jobeet2Bundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @ORM\prePersist
     */
    public function doStuffOnPrePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\preUpdate
     */
    public function doStuffOnPreUpdate()
    {
        // Add your code here
    }
}