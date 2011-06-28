<?php

namespace Application\Jobeet2Bundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class JobRepository extends EntityRepository
{
    
	public function findOneById($id)
	{
		return $this->findOneBy(array('id' => $id));
	}
	
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }

    public function findOneByToken($token)
    {
        return $this->findOneBy(array('token' => $token));
    }
    
    /**
     * 
     * Fetch active jobs
     * @return Array of Job Class
     */
    
    public function  getActiveJobs()
    {
    	return $this->addActiveJobsQuery()->getResult();
    }
    
    /**
     * Number of active jobs
     * @param QueryBuilder $qb
     * @return scalar
     */
    
    public function countActiveJobs()
    {
    	return $this->addActiveJobsQuery()->count()->getSingleScalarResult();
    }
    
    /**
     * Build query for active jobs
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    
    public function addActiveJobsQuery(QueryBuilder $qb = null)
    {
    	if ($qb === null)
    	{
    		$qb = $this->createQueryBuilder('j')
    			->select('j');    			
    	}
    	$date = new \DateTime('now');
    	
    	$qb->andWhere('j.expires_at > :date')
            ->andWhere('j.is_activated = 1')
    		->addOrderBy('j.created_at', 'DESC')    		
    		->setParameter('date', $date->format('Y-m-d'));    		    	
    		
    	return $qb->getQuery();    	
    }    
    
	public function getActiveJobsByCategoryQuery(Category $category)
    {
    	$qb = $this->createQueryBuilder('j')    	       
    		->innerJoin('j.category','c','WITH','c = :category')    		
    		->setParameter('category', $category);
    	    		
    	return $this->addActiveJobsQuery($qb);    	
    }
    
    public function getActiveJobsByCategory(Category $category, $max = 10)
    {
    	return $this->getActiveJobsByCategoryQuery($category)
    		->setMaxResults($max)    		
    		->getResult();
    }
}