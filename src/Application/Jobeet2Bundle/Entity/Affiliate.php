<?php

namespace Application\Jobeet2Bundle\Entity;

/**
 * Application\Jobeet2Bundle\Entity\Affiliate
 */
class Affiliate
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $token
     */
    private $token;

    /**
     * @var boolean $is_active
     */
    private $is_active;

    /**
     * @var Application\Jobeet2Bundle\Entity\Category
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
}