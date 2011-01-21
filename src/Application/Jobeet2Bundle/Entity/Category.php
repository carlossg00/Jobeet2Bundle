<?php

namespace Application\Jobeet2Bundle\Entity;

/**
 * Application\Jobeet2Bundle\Entity\Category
 */
class Category
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var Application\Jobeet2Bundle\Entity\Job
     */
    private $job;

    /**
     * @var Application\Jobeet2Bundle\Entity\Category
     */
    private $affiliates;

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
}